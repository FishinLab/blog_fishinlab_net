import MySQLdb
import sys
import os
import re

class syncer(object):
    
    def __init__(self, user_name = '', host = '', passwd = '', db_name = ''):
        self.user_name = user_name
        self.host = host
        self.passwd = passwd
        self.db_name = db_name

    def sync_operation(self, sql):

        db = MySQLdb.connect(host = self.host,user = self.user_name, db = self.db_name, passwd = self.passwd)
        cursor = db.cursor()

        if(sql is not None):
            cursor.execute(sql)

        cursor.close()

    def init_page_file_table(self, index_html_path):
        
        if(index_html_path is not None):
            
            fd_index = open(index_html_path, 'r')
            fd_index_list = []
            fd_index_list.append(fd_index.readlines())
            fd_index.close()

            index_id = 0
            for line in fd_index_list:
                insert_sql = "insert into page_files value ( id = " + str(index_id) + ", file_name = " + str(line) + ";"

                db = MySQLdb.connect(host = self.host, user = self.user_name, passwd = user.passwd, db = self.db_name)
                cur  = db.cursor()
                cur.execute(insert_sql)

                cur.close()

def main(user_name, host, passwd, db_name, sqls):
    sy = syncer(user_name, host, passwd, db_name)
    sy.sync_operation(sql)

if __name__ == '__main__':
    user_name = 'root' 
    host = '127.0.0.1' 
    passwd = 'mysql'
    db_name = 'web_db'
    
    sqls = ['create table users (id int(16) primary key, user_name varchar(256) not null) engine = innoddb;',
            'create table user_friens (id int(16) primary key, user_name varchar(256) not null, fri_name varchar(256) not null) engine = innodb;',
            'create table user_num_map (id int(16) primary key, user_name varchar(256) not null, user_num varchar(256) not null ) engine = innodb;']

    for sql in sqls:
        main(user_name, host, passwd, db_name , sql)
