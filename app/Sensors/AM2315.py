#!/usr/bin/python
# Author: Ciarán O'Mara

import smbus
import time

bus = smbus.SMBus(1)  # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)

DEVICE_ADDRESS = 0x5c
AM2315_WAITTIME = 0.150

# Wake up the sensor (by sending nonsense and ignoring error).
try:
    bus.write_byte(DEVICE_ADDRESS, 0x00)
except:
    time.sleep(0.0015)  # 800µs to 3ms

# OK lets ready!
bus.write_i2c_block_data(DEVICE_ADDRESS, 0x03, [0x00, 0x04])

time.sleep(AM2315_WAITTIME)  # add delay between request and actual read!

reply = bus.read_i2c_block_data(DEVICE_ADDRESS, 0x00, 8)

# Calculate humidity.
humidity = reply[2]
humidity *= 256
humidity += reply[3]
humidity /= 10

# Calculate temperature.
temp = reply[4] & 0x7F
temp *= 256
temp += reply[5]
temp /= 10

# change sign
if reply[4] >> 7:
    temp = -temp

# Print result to console
print("{} {}".format(humidity, temp))
