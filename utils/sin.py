#!/usr/bin/python
import math, datetime
mult = 0
now = datetime.datetime.now()
for i in range(255):
    #print "INSERT INTO `flowMeter`.`readings` (`flow`, `volume`, `date`) VALUES ('{:f}', '{:f}', '2015-12-11 18:{:d}:58');".format( math.sin(3.1415*0.1*i), math.sin(3.1415*0.1*i+(3.1415/)/5 ), i )
    print "INSERT INTO `flowMeter`.`readings` (`flow`, `volume`, `date`) VALUES ('{}', '{}', '{}');".format( 10*math.sin(3.1415*0.1*i), 10*math.sin( 3.1415*0.1*i+(3.1415)/5  ), now.strftime('%Y-%m-%d %H:%M:%S') )
    now += datetime.timedelta(minutes=1)

