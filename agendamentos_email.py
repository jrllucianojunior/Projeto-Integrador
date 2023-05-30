import datetime
import mysql.connector
import smtplib
from email.mime.text import MIMEText

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': 'senha',
    'database': 'projeto_integrador'
}

email_config = {
    'smtp_host': 'smtp.gmail.com',
    'smtp_port': 587,
    'email': 'email@gmail.com',
    'password': 'senha',
    'sender_name': 'Matheus',
    'subject': 'Lembrete de Agendamento'
}

# Conecta ao banco de dados
db_connection = mysql.connector.connect(**db_config)
db_cursor = db_connection.cursor()

current_datetime = datetime.datetime.now()

one_week_later = current_datetime + datetime.timedelta(weeks=1)

current_date = current_datetime.date()
one_week_later_date = one_week_later.date()

query = "SELECT u.email, e.tarefa FROM entrevistas e INNER JOIN usuarios u ON e.id_user = u.id WHERE e.data_entrevista BETWEEN %s AND %s AND e.hora = '12:00'"
db_cursor.execute(query, (current_date, one_week_later_date))
results = db_cursor.fetchall()

for result in results:
    email = result[0]
    tarefa = result[1]
    
    message = f"Olá,\n\nEste é um lembrete para a sua tarefa de agendamento: {tarefa}.\n\nAtenciosamente,\n{email_config['sender_name']}"
    
    mime_message = MIMEText(message)
    mime_message['Subject'] = email_config['subject']
    mime_message['From'] = email_config['email']
    mime_message['To'] = email
    
    smtp_server = smtplib.SMTP(email_config['smtp_host'], email_config['smtp_port'])
    smtp_server.starttls()
    smtp_server.login(email_config['email'], email_config['password'])
    smtp_server.send_message(mime_message)
    smtp_server.quit()

db_cursor.close()
db_connection.close()