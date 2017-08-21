import sqlite3
import os

conn = sqlite3.connect('db.sqlite')
conn.execute('drop table if exists cameras')
conn.execute('drop table if exists videos')
conn.execute('drop table if exists frames')

conn.execute('''CREATE TABLE `cameras` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name`	TEXT NOT NULL UNIQUE
);''')

conn.execute('''CREATE TABLE `videos` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`camera_id`	integer NOT NULL,
	`datetime`	datetime NOT NULL,
	FOREIGN KEY(`camera_id`) REFERENCES `cameras`(`id`)
)''')

conn.execute('''CREATE TABLE `frames` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`video_id`	integer NOT NULL,
	`seq`	integer NOT NULL,
	`data`	blob NOT NULL,
	FOREIGN KEY(`video_id`) REFERENCES `videos`(`id`)
)''')

for camera in os.listdir('cams'):
    c = conn.execute('insert into cameras(name) values(?)',[camera])
    camera_id = c.lastrowid
    for clip in os.listdir('cams/{}'.format(camera)):
        c = conn.execute('insert into videos(camera_id,datetime) values(?,?)',[camera_id, clip])
        video_id = c.lastrowid
        for frame in os.listdir('cams/{}/{}'.format(camera,clip)):
            with open('cams/{}/{}/{}'.format(camera,clip,frame),'rb') as frame_data:
                seq = int(frame.split('.')[0])
                conn.execute('insert into frames(video_id,seq,data) values(?,?,?)',[video_id, seq, frame_data.read()])

conn.commit()
conn.close()
