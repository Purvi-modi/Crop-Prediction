import requests
import sys
#email_id =" "
email_id = sys.argv[1]
message =""
for i in range(2,len(sys.argv)):
    message+=" "+sys.argv[i]
def send_simple_message(e_id,mess):
    return requests.post(
        "https://api.mailgun.net/v3/sandboxf7cf7999b48c4e9ba44dd4307888b968.mailgun.org/messages",
             auth=("api", "13317e862fc718d0070527c4cedc9f1d-e566273b-a699fc7e"),
              data={"from": "Mailgun Sandbox <postmaster@sandboxf7cf7999b48c4e9ba44dd4307888b968.mailgun.org>",
              "to":  "seed project <seedproject2019@gmail.com>",
              "subject": "Report",
              "text": mess})
print email_id
print message
send_simple_message(email_id,message)



