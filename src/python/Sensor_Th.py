#!/usr/bin/python

from threading import Thread, Semaphore
import time

##{ just for local testing, while i'm not with Pi, later a socket will be replaced by GPIO interruption.
import socket

HOST = ''              # Endereco IP do Servidor
PORT = 5000            # Porta em que o servidor esta escutando
tcp = socket.socket(socket.AF_INET, socket.SOCK_STREAM) #instancia do objeto socket
orig = (HOST, PORT)
tcp.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

tcp.bind(orig)#solicita os recursos do socket ao SO
tcp.listen(1024)#inicia a escuta na porta aceitando no maximo 1024 conexoes.

##}

class Sensor_Th(Thread):

    def __init__(self, threadID, name, consoleLock, appFlags, logFlag):
        Thread.__init__(self)
        self.threadID = threadID
        self.name = name
        self.consoleLock = consoleLock
        self.appFlags = appFlags
        self.logFlag = logFlag

    def syncPrint(self,msg):
        self.consoleLock.acquire()
        if self.logFlag:
            file = open("./log.log","a")
            file.write("["+time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime())+"]"+self.name+" says: "+msg+"\n")
            file.close()
        else:
            print "["+time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime())+"]"+self.name+" says: "+msg+"\n"
        self.consoleLock.release()

    def run(self):
        self.syncPrint("I'm running")
        while self.appFlags["running"]:
            con, clientAddress = tcp.accept()#espera BLOQUEADO ateh que alguem se conecte
            self.syncPrint(str(clientAddress)+" connected.")
            con.close()
            self.syncPrint(str(clientAddress)+" was closed.")
        self.syncPrint("I stopped.")

if __name__ == "__main__":
    conLock = Semaphore(value=1)
    flags={"running": True}
    mySensor_Th = Sensor_Th(threadID=1, name="SensorThread", consoleLock=conLock, appFlags=flags, logFlag=False)
    mySensor_Th.start()
    print "System halted."

