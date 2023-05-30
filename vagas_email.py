import json
import requests
import smtplib
import schedule
import time
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from flask import Flask, request
from selenium import webdriver
from flask_cors import CORS, cross_origin
import sqlite3

app = Flask(__name__)

cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

def send_email(to_email, subject, message):

    from_email = 'matheus.menesio@gmail.com'
    password = 'senha'

    msg = MIMEMultipart()
    msg['From'] = from_email
    msg['To'] = to_email
    msg['Subject'] = subject

    msg.attach(MIMEText(message, 'plain'))

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()

    server.login(from_email, password)

    server.send_message(msg)

    server.quit()

def get_vagas_infojobs(id):
    conn = sqlite3.connect('perfil_usuario.db')
    cursor = conn.cursor()

    cursor.execute("SELECT cargo, escolaridade, curso, cidade, faixa_salario, email FROM perfil_usuario where id_usuario = ?", (id,))
    perfil_usuario = cursor.fetchone()

    if perfil_usuario:
        cargo, escolaridade, curso, cidade, faixa_salario, email = perfil_usuario

        url_infojobs = "https://www.infojobs.com.br/"
        options = Options()
        options.add_argument("--accept-all-cookies")
        options.add_argument("--headless")  # Executar o navegador em modo headless

        navegador = webdriver.Chrome(executable_path=r'C:\Users\Public\chromedriver.exe', options=options)

        navegador.get(url_infojobs)
        navegador.execute_script("document.charset = 'UTF-8';")

        WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.XPATH, "//button[@id = 'didomi-notice-agree-button']")))
        aceita_cookies = navegador.find_element(By.XPATH, "//button[@id = 'didomi-notice-agree-button']")
        aceita_cookies.click()

        input_vaga = navegador.find_element(By.XPATH, "//input[@name = 'keywordsCombo']")
        input_vaga.send_keys(cargo)

        # Obtém o valor de salário selecionado no seu site
        faixa_salario_selecionada = perfil_usuario[4]  # Índice 4 representa a faixa salarial no perfil_usuario

        if faixa_salario_selecionada == "A combinar":
            faixa_salario_infojobs = '12'
        else:
            valor_minimo, valor_maximo = faixa_salario_selecionada.split('-')

        if valor_minimo == '1000' and valor_maximo == '2000':
            faixa_salario_infojobs = '2'
        elif valor_minimo == '2000' and valor_maximo == '3000':
            faixa_salario_infojobs = '3'
        elif valor_minimo == '3000' and valor_maximo == '4000':
            faixa_salario_infojobs = '4'
        elif valor_minimo == '4000' and valor_maximo == '5000':
            faixa_salario_infojobs = '5'
        elif valor_minimo == '5000' and valor_maximo == '6000':
            faixa_salario_infojobs = '6'
        elif valor_minimo == '6000' and valor_maximo == '7000':
            faixa_salario_infojobs = '7'
        elif valor_minimo == '7000' and valor_maximo == '8000':
            faixa_salario_infojobs = '8'
        elif valor_minimo == '8000' and valor_maximo == '9000':
            faixa_salario_infojobs = '9'
        elif valor_minimo == '9000' and valor_maximo == '10000':
            faixa_salario_infojobs = '10'
        elif valor_minimo == '10000' and valor_maximo == '15000':
            faixa_salario_infojobs = '11'
        else:
            faixa_salario_infojobs = ''  # Faixa salarial não correspondente no Infojobs

        if faixa_salario_infojobs:
            faixa_salario_element = navegador.find_element(By.XPATH, f"//a[@data-key='isr'][@value='{faixa_salario_infojobs}']")
            faixa_salario_element.click()

        input_vaga_click = navegador.find_element(By.XPATH, "//a[@role = 'button']")
        input_vaga_click.click()

        vagas = navegador.find_elements(By.XPATH, "//div[@class= 'd-flex ']")
        vagas_json = []

        for vaga in vagas:
            # Obtém a data de cadastro da vaga
            data_cadastro = vaga.find_element(By.XPATH, "//div[@class='ml-auto d-flex flex-column align-items-end text-nowrap']//div[@class='text-medium small']")
            data_cadastro_texto = data_cadastro.text

            # Verifica se a vaga foi cadastrada hoje e se a escolaridade é correspondente
            if data_cadastro_texto == 'Hoje' and escolaridade == experiencia_desejada_texto:
                # Obtém as informações da vaga
                wait = WebDriverWait(navegador, 10)

                titulo_element = wait.until(EC.visibility_of_element_located(By.XPATH, "//h2[@class='text-h4 mb-0']"))
                titulo_texto = titulo_element.text

                empresa_element = wait.until(EC.visibility_of_element_located(By.XPATH, "//a[@class='text-primary']"))
                empresa_texto = empresa_element.text

                salario_element = wait.until(EC.visibility_of_element_located(By.XPATH, "//div[@class='d-flex flex-column']//span[@class='text-h4']"))
                salario_texto = salario_element.text

                desc_element = wait.until(EC.visibility_of_element_located(By.XPATH, "//div[@class='description']"))
                desc_texto = desc_element.text

                experiencia_desejada = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class='mb-32']")))
                experiencia_desejada_texto = experiencia_desejada.text

                contrato = wait.until(EC.visibility_of_element_located((By.XPATH, "//span[contains(text(),'Tipo de contrato e Jornada:')]")))
                contrato_texto = contrato.text

                tipo_trabalho = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class='text-medium small font-weight-bold mb-4']")))
                tipo_trabalho_texto = tipo_trabalho.text

        conn.close()

    else:
        # Fechar a conexão com o banco de dados
        conn.close()
        return None


def send_daily_vagas_email():
    # Conectar ao banco de dados
    conn = sqlite3.connect('perfil_usuario.db')
    cursor = conn.cursor()

    cursor.execute("SELECT id_usuario, email FROM perfil_usuario")
    usuarios = cursor.fetchall()

    total_vagas = 0

    for usuario in usuarios:
        id_usuario, email = usuario

        vagas = get_vagas_infojobs(id_usuario)

        if vagas:
            vagas_hoje = sum(1 for vaga in vagas if 'Hoje' in vaga['data_cadastro'])
            total_vagas += vagas_hoje


            # Enviar e-mail para o usuário com a quantidade de vagas cadastradas hoje
            subject = 'Vagas de emprego cadastradas hoje'
            message = f'Foram cadastradas {vagas_hoje} vagas de emprego hoje. Acesse para verificar'
            send_email(email, subject, message)

    subject_admin = 'Total de vagas de emprego cadastradas hoje'
    message_admin = f'Foram cadastradas um total de {total_vagas} vagas de emprego hoje. Acesse para verificar'
    send_email('admin@example.com', subject_admin, message_admin)

    conn.close()


def index():
    schedule.every().day.at("12:00").do(send_daily_vagas_email)

    while True:
        schedule.run_pending()
        time.sleep(1)

if __name__ == '__main__':
    index()
    app.run(debug=True)