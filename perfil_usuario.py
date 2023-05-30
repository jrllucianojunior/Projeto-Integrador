import json
import requests
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

@app.route('/getperfil/<string:id>', methods=['GET', 'POST'])
@cross_origin()
def index(id):
    # Conectar ao banco de dados
    conn = sqlite3.connect('perfil_usuario.db')
    cursor = conn.cursor()

    # Obter perfil do usuário do banco de dados
    cursor.execute("SELECT cargo, escolaridade, curso, cidade, faixa_salario FROM perfil_usuario where id_usuario  ?", (id,))
    perfil_usuario = cursor.fetchone()

    if perfil_usuario:
        cargo, escolaridade, curso, cidade, faixa_salario = perfil_usuario

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

            vaga.click()

            wait = WebDriverWait(navegador, 10)

            titulo = wait.until(EC.visibility_of_element_located((By.XPATH, "//h2[@class = 'font-weight-bolder mb-4']")))
            titulo_texto = titulo.text

            empresa = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class = 'h4']")))
            empresa_texto = empresa.text

            salario = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class = 'text-medium mb-4'][2]")))
            salario_texto = salario.text

            desc = wait.until(EC.visibility_of_element_located((By.XPATH, "//p[@class='mb-16 text-break white-space-pre-line']")))
            desc_texto = desc.text

            experiencia_desejada = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class = 'mb-32']")))
            experiencia_desejada_texto = experiencia_desejada.text

            contrato = wait.until(EC.visibility_of_element_located((By.XPATH, "//span[contains(text(),'Tipo de contrato e Jornada:')]")))
            contrato_texto = contrato.text

            tipo_trabalho = wait.until(EC.visibility_of_element_located((By.XPATH, "//div[@class = 'text-medium small font-weight-bold mb-4']")))
            tipo_trabalho_texto = tipo_trabalho.text

            if escolaridade == experiencia_desejada_texto:
               dados_vaga = {
                             'titulo': titulo_texto,
                             'empresa': empresa_texto,
                             'salario': salario_texto,
                             'descricao': desc_texto,
                             'experiencia_desejada': experiencia_desejada_texto,
                             'contrato': contrato_texto,
                             'tipo_trabalho': tipo_trabalho_texto,
                             }

            vagas_json.append(dados_vaga)

        # Fechar a conexão com o banco de dados
        conn.close()

        return json.dumps(vagas_json)

    else:
        # Fechar a conexão com o banco de dados
        conn.close()

        return "Perfil do usuário não encontrado no banco de dados"


@app.route('/getperfil/', methods=['OPTIONS'])
@cross_origin()
def handle_options():
    response = app.make_default_options_response()
    response.headers['Access-Control-Allow-Methods'] = 'POST'
    response.headers['Access-Control-Allow-Headers'] = 'Content-Type'
    return response

app.run(debug=True)