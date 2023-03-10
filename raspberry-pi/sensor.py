import RPi.GPIO as GPIO
import time,os

import datetime

TRIG = 6
ECHO = 5
ALARM = 23

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

GPIO.setup(TRIG,GPIO.OUT)
GPIO.setup(ECHO,GPIO.IN)
GPIO.output(TRIG, False)

GPIO.setup(ALARM,GPIO.OUT)
GPIO.output(ALARM, True)

print ("Waiting For Sensor To Settle")
time.sleep(1)

 	#settling time 
def get_distance():
	dist_add = 0
	for x in range(20):
		try:
			GPIO.output(TRIG, True)
			time.sleep(0.00001)
			GPIO.output(TRIG, False)

			while GPIO.input(ECHO)==0:
				pulse_start = time.time()

			while GPIO.input(ECHO)==1:
				pulse_end = time.time()

	#the ultrasonic sensor reading data from the tank.
			pulse_duration = pulse_end - pulse_start
			
			distance = pulse_duration * 17150

			distance = round(distance, 3)
			print (x, "distance: ", distance)
	
	# add the different distances together
			dist_add = dist_add + distance
			#print "dist_add: ", dist_add
			time.sleep(.1) # 100ms interval between readings
		
		except Exception as e: 
		
			pass

	#gets the average of 20 values from the sensor to establish an absolute value to send to the webserver.
	avg_dist=dist_add/20
	dist=round(avg_dist,3)

	#print ("dist: ", dist)
	return dist

	#function for sending data to the webserver.
def sendData_to_remoteServer(dist):
	
	url_remote="http://localhost/water-tank/insert_data.php?dist=" + str(dist)
	cmd="curl -s " + url_remote
	result=os.popen(cmd).read()
	print (cmd)
	
		
	
def low_level_warning(dist):

#set your tank height here	
	tank_height=200 
	level=tank_height-dist
	if(level<40):
		print("level low : ", level)
		GPIO.output(ALARM, False)
	else:
		GPIO.output(ALARM, True)
		print("level ok")
		

def main():
	
	distance=get_distance()
	
	print ("distance: ", distance)
	sendData_to_remoteServer(distance)
	low_level_warning(distance)
	print ("---------------------")
	
	
if __name__ == '__main__':
    main()

