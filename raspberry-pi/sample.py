import random, os

def measure_distance():
	#.randrange(5, 100)
	d=random.random.randint(5,100)
	return d

def sendData_to_remoteServer(dist):
	url_remote="http://localhost/water-tank/insert_data.php?dist=" + str(dist)
	cmd="curl -s " + url_remote
	result=os.popen(cmd).read()
	print (cmd)
	
def main():
	
	dist = measure_distance()
	sendData_to_remoteServer(dist)
	
	
if __name__ == '__main__':
    main()
