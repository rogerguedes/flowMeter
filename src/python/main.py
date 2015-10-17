#!/usr/bin/python

#This script are responsible for manage all other threads, such as MQTT publisher, Sensor Thread, and data sush total volume measured and last flow across the meter.

from HidroMeter import HidroMeter
from Sensor_Th import Sensor_Th
from threading import Semaphore
from SocketHandlers.SocketsPoll import SocketsPoll
import socket

#generalVars

conLock = Semaphore(value=1)
flags={"running": True}

#generalFuctions

def printMenu():
    conLock.acquire()
    print "Enter some option bellow:"
    print "exit: exit main thread;"
    conLock.release()


YF_S201 = HidroMeter(spinFactor=4.5, minFlow=1, maxFlow=30)

FlowSensor_Th = Sensor_Th(threadID=1, name="SensorThread", consoleLock=conLock, appFlags=flags, logFlag=False)
FlowSensor_Th.start()


printMenu()
keyboardInput = raw_input(">>>")

while True:
    if keyboardInput == "exit":
        flags["running"] = False
        break
    else:
        printMenu()
    keyboardInput = raw_input(">>>")


print "System halted."

