import sys
import requests
import json
from bs4 import BeautifulSoup
import database

form_headers = {
    'Accept': '*/*',
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    'Origin': 'https://vjudge.net',
    'Referer': 'https://vjudge.net/',
    'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
    'X-Requested-With': 'XMLHttpRequest'
}

login_data = {
    'username': 'RAJAN',
    'password': '133502'
}

def login(s):
    #print("Logging in https://vjudge.net. Please wait...")
    login_url = "https://vjudge.net/user/login"
    s.post(login_url,data=login_data,headers=form_headers)
    #print("Logged in successfully...")

def get_participant_submission_info(contest_id,s):
    participant_submission_url = "https://vjudge.net/contest/rank/single/" + contest_id
    participant_submission_json = s.get(participant_submission_url, cookies=requests.cookies.RequestsCookieJar()).text
    participant_submission = json.loads(participant_submission_json)
    return participant_submission

def get_problem_info(contest_id,s):
    problem_url = "https://vjudge.net/contest/"+contest_id+"#rank"
    problem_html_page = s.get(problem_url, cookies=requests.cookies.RequestsCookieJar())
    soup = BeautifulSoup(problem_html_page.content, "html5lib")
    problem_otherinfo_json = soup.find('textarea', attrs={"name": "dataJson"}).string
    problem_plus_otherinfo = json.loads(problem_otherinfo_json)
    return problem_plus_otherinfo

def problem_point_input(problem_list,problem_point):
    for num,name in problem_list:
        problem_point[num] = 1

def main(contest_url):
    with requests.Session() as s:
        login(s=s)
        #contest_url = input("Enter vjudge contest url:")

        contest_id  = contest_url.strip().split('/')[-1]
        participant_submission_all_info = get_participant_submission_info(contest_id=contest_id,s=s)

        #print("Rank list has been fetched successfully...\n")


        #  participants dictionary format
        # "participants": {"139291": ["TasdidurRahman", "2016331053"], "141386": ["MYTE", "MYTE_2016831021"],
        #                  "208494": ["SUST_RubiksQube", "JOS"], "227598": ["SUST_MohaSunno", "Nazmul,Apu,Anis"],
        #                  "229234": ["SUST_LogoutCoder", "Yusuf,Mehedi,Tiham"],
        #                  "230123": ["team_", "Maruf,Humayan,Ayesha"]}

        participants_dict = participant_submission_all_info["participants"]



        participant_id_list = []



        for id in participants_dict:
            participant_id_list.append(id)

        problem_plus_otherinfo = get_problem_info(contest_id=contest_id,s=s)

        #  problems dictionary format
        # "problems": [{"pid": 1253904, "title": "Arranging Wine", "oj":
        # "Kattis", "probNum": "arrangingwine", "num": "A"}]

        problems_dict = problem_plus_otherinfo["problems"]
        problem_list = []
        problem_info_for_db_table = []



        contest_title = problem_plus_otherinfo["title"]
        contest_id_no = problem_plus_otherinfo["id"]

        problem_idx = 0

        for single_problem in problems_dict:
            problem_list.append((single_problem["num"],single_problem["title"]))
            problem_info_for_db_table.append((str(contest_id_no),contest_title,single_problem["oj"],problem_idx,single_problem["title"],1))
            problem_idx = problem_idx + 1

        problem_point = {}
        problem_point_input(problem_list=problem_list,problem_point=problem_point)

        # penalty_tracker is a dictionary where key: tuple of (problem num,contestant id),value:no of non ac sbmissions

        penalty_tracker = {}
        num = 0
        for _ in problem_list:
            for id in participant_id_list:
                penalty_tracker[(num,id)] = 0
            num = num + 1

        participant_solved_problem_list = {}

        for id in participant_id_list:
            participant_solved_problem_list[id] = []

        #  submissions dictionary format
        # "submissions": [[208494, 8, 1, 1101, 23.0, 23.0], [230123, 8, 1, 1191, 23.0, 23.0],
        #                 [208494, 1, 0, 1730, 1.0, 43.0], [208494, 1, 0, 2154, 1.0, 43.0],
        #                 [208494, 2, 1, 2460, 32.0, 32.0], [230123, 2, 1, 3183, 32.0, 32.0]]
        # "submissions": [participant_id,problem_no,is_ac,time_collapse,...,...]

        submission_dict = participant_submission_all_info["submissions"]
        contest_duration = participant_submission_all_info["length"]/1000

        participant_problem_solve_moment = {}







        for single_submission in submission_dict:


            participant_id = str(single_submission[0])
            problem_num = single_submission[1]
            is_ac = single_submission[2]
            time_collapse = single_submission[3]
            if not is_ac:
                penalty_tracker[(problem_num,participant_id)] += 1
            if is_ac and time_collapse <= contest_duration:
                participant_solved_problem_list[participant_id].append(problem_num)
                participant_problem_solve_moment[(problem_num,participant_id)] = time_collapse




        record = []







        #print("{} {}".format(contest_title,contest_id_no))

        for id in participant_id_list:
            solved_problem_list = participant_solved_problem_list[id]

            solved_problem_list.sort()

            solved_mask = [0]*200
            for idx in solved_problem_list:
                solved_mask[idx] = 1

            mask = "".join([chr(ch+48) for ch in solved_mask])

            time_penalty = 0
            for problem in solved_problem_list:
                time_penalty += (penalty_tracker[(problem,id)]*20*60 + participant_problem_solve_moment[(problem,id)])
            time_penalty/=60
            time_penalty = int(time_penalty)
            gained_points = len(solved_problem_list)


            record.append((participants_dict[id][0],contest_id_no,mask,gained_points,time_penalty))








        database.insert_in_database(record=record,problem_oj_title_tuple=problem_info_for_db_table)







if __name__ == '__main__':
    url = sys.argv[1]
    main(contest_url=url)

