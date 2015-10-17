#!/usr/bin/python

#This class was created to store the messurement data of hydrometer system, all other classes and threads goes take hydrometer information from this class.

from threading import Semaphore

class HydroMeter():
    def __init__(self, spinFactor=4.5, minFlow=1, maxFlow=30):
        self.spinFactor = spinFactor
        self.minFlow =  minFlow
        self.maxFlow = maxFlow
        self._volume = 0
        self._flow = 0
        self._semaphore = Semaphore(value=1) 
    def __repr__(self):
        return str(self.__dict__)
    
    @property
    def volume(self):
        self._semaphore.acquire()
        return self._volume
        self._semaphore.release()

    @volume.setter
    def volume(self, vol):
        self._semaphore.acquire()
        self._volume = vol
        self._semaphore.release()

    @volume.deleter
    def volume(self, vol):
        self._semaphore.acquire()
        del self._volume
        self._semaphore.release()

    @property
    def flow(self):
        self._semaphore.acquire()
        return self._flow
        self._semaphore.release()

    @flow.setter
    def flow(self, vol):
        self._semaphore.acquire()
        self._flow = vol
        self._semaphore.release()

    @flow.deleter
    def flow(self, vol):
        self._semaphore.acquire()
        del self._flow
        self._semaphore.release()

if __name__ == "__main__":
    myMeter = HydroMeter()
    print myMeter

