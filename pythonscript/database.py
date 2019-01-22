import mysql.connector
import datetime

def establish_connection():

    mydb = mysql.connector.connect(
    host = "localhost",
    user = "phpmyadmin",
    passwd = "12345",
    database="Ipcalpha"
    )
    return mydb

def insert_only(tuple,mydb,mycursor):

    #print("this key does not exist in database : {}".format(tuple))

    query = ("INSERT INTO ranklists (username,contest_id,solved_mask,score,penalty) VALUES {}".format(tuple))
    mycursor.execute(query)
    mydb.commit()





def insert_in_problem_info_table(problem_oj_titile_tuple,mydb,mycursor):
    for tuple in problem_oj_titile_tuple:
        query = ("insert into problems (contest_id,contest_title,oj,problem_num,problem_name,weighted_point) values {}".format(tuple))
        mycursor.execute(query)
        mydb.commit()

def insert_in_database(record,problem_oj_title_tuple):
    mydb = establish_connection()
    mycursor = mydb.cursor()

    insert_in_problem_info_table(problem_oj_titile_tuple=problem_oj_title_tuple,mydb=mydb,mycursor=mycursor)

    for tuple in record:
        insert_only(tuple,mydb,mycursor)



