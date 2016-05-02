#!/usr/bin/python

import MySQLdb

conn = MySQLdb.connect(host = 'localhost', port = 3306, user = 'root', passwd = 'root', db = 'demo')
cur = conn.cursor(MySQLdb.cursors.DictCursor);
count = cur.execute("select * from simple_user")

print cur.fetchall()

cur.close()
conn.close()

