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
from classificador import classify_review


application = Flask(__name__)

cors = CORS(application)
application.config['CORS_HEADERS'] = 'Content-Type'


@application.route('/getvagas/<string:msg>', methods=['GET', 'POST'])
@cross_origin()
def index(empresa):
    
    empresa_selecionada = empresa

    url_indeed = "https://www.infojobs.com.br/ranking-melhores-empresas.aspx"
 
    navegador = webdriver.Chrome()

    navegador.get(url_indeed)
    navegador.execute_script("document.charset = 'UTF-8';")


    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.ID, "didomi-notice-agree-button")))
    aceita_cookies = navegador.find_element(By.XPATH, "//button[@id = 'didomi-notice-agree-button']")
    aceita_cookies.click()

    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.ID, 'txtCompany')))
    input_vaga = navegador.find_element(By.ID, 'txtCompany')
    input_vaga.send_keys(empresa_selecionada)

    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.XPATH, "//a[@role = 'button']")))
    input_vaga_click = navegador.find_element(By.XPATH, "//a[@role = 'button']")
    input_vaga_click.click()

    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'col-12')))
    seleciona_empresa = navegador.find_element(By.CLASS_NAME, 'col-12')
    seleciona_empresa.click()

    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'advisor-top-value-text')))
    encontra_avaliacoes = navegador.find_element(By.CLASS_NAME, 'advisor-top-value-text')
    encontra_avaliacoes.click()

    avaliacao_geral = navegador.find_element(By.CLASS_NAME,'advisor-general-num').text  
    print(avaliacao_geral)

    avaliacoes_empresa = navegador.find_elements(By.CLASS_NAME, 'advisor-top-anchor')
    avaliacao_list_classificada = []

    for avaliacoes_de_empresas in avaliacoes_empresa:
        WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.CLASS_NAME, "advisor-top-title")))
        titulo_avaliacao = avaliacoes_de_empresas.find_element(By.CLASS_NAME, 'advisor-top-title').text
        funcionario = avaliacoes_de_empresas.find_element(By.CLASS_NAME, 'advisor-top-date').text
        texto_avaliacao = avaliacoes_de_empresas.find_element(By.CLASS_NAME, 'advisor-top-text').text
        print(titulo_avaliacao)
    
        classificacao = classify_review(texto_avaliacao)

 
        avaliacao_dict = {
            "titulo": titulo_avaliacao,
            "avaliacao": texto_avaliacao,
            "classificacao": classificacao

        } 


        avaliacao_list_classificada.append(avaliacao_dict)
    

        # Defina a URL do localhost
    url = 'http://localhost:5000/getvagas/'

        # Enviar o JSON usando o método POST da biblioteca requests
    response = requests.post(url, json=avaliacao_list_classificada)

        # Verifique o status da resposta
    if response.status_code == 200:
       print('JSON enviado com sucesso para o localhost')
    else:
       print('Ocorreu um erro ao enviar o JSON para o localhost')
    navegador.back()

    return json.dumps(avaliacao_list_classificada)


@application.route('/get/', methods=['OPTIONS'])
@cross_origin()
def handle_options():
    response = application.make_default_options_response()
    response.headers['Access-Control-Allow-Methods'] = 'POST'
    response.headers['Access-Control-Allow-Headers'] = 'Content-Type'
    return response


application.run(debug=True)