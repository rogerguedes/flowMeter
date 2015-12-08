#!/usr/bin/env python2.7  
import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)  
GPIO.setup(23, GPIO.IN, pull_up_down=GPIO.PUD_UP)
counter = 0
GPIO.wait_for_edge(23, GPIO.FALLING)
now = time.time()
while True:
    try:  
        GPIO.wait_for_edge(23, GPIO.FALLING)
        last = now
        now = time.time()
        print "Interruption number: {}; Time: {};".format(counter, now-last)
        counter += 1
    except KeyboardInterrupt:  
        GPIO.cleanup()       # clean up GPIO on CTRL+C exit  
GPIO.cleanup()           # clean up GPIO on normal exit

