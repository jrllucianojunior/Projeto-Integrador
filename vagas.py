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

appi = Flask(__name__)

cors = CORS(appi)
appi.config['CORS_HEADERS'] = 'Content-Type'


@appi.route('/get/<string:msg>', methods=['GET'])
@cross_origin()
def index(msg):

    vaga = msg

    url_infojobs = "https://www.infojobs.com.br/"
    options = Options()
    options.add_argument("--accept-all-cookies")

    navegador = webdriver.Chrome(executable_path=r'C:\Users\Public\chromedriver.exe')

    navegador.get(url_infojobs)
    navegador.execute_script("document.charset = 'UTF-8';")

    WebDriverWait(navegador, 10).until(EC.presence_of_element_located((By.XPATH, "//button[@id = 'didomi-notice-agree-button']")))
    aceita_cookies = navegador.find_element(By.XPATH, "//button[@id = 'didomi-notice-agree-button']")
    aceita_cookies.click()

    input_vaga = navegador.find_element(By.XPATH, "//input[@name = 'keywordsCombo']")
    input_vaga.send_keys(vaga)
    input_vaga_click = navegador.find_element(By.XPATH, "//a[@role = 'button']")
    input_vaga_click.click()

    vagas = navegador.find_elements(By.XPATH, "//div[@class= 'd-flex ']")
    vagas_json = []

    num_vagas_desejado = 5
    num_vagas = 0

    for vaga in vagas:
        if num_vagas >= num_vagas_desejado:
            break

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
        num_vagas += 1

        # Defina a URL do localhost
    url = 'http://localhost:5000/get/'

        # Enviar o JSON usando o método POST da biblioteca requests
    response = requests.post(url, json=vagas_json)

        # Verifique o status da resposta
    if response.status_code == 200:
        print('JSON enviado com sucesso para o localhost')
    else:
        print('Ocorreu um erro ao enviar o JSON para o localhost')
    navegador.back()

    return json.dumps(vagas_json)


@appi.route('/get/', methods=['OPTIONS'])
@cross_origin()
def handle_options():
    response = appi.make_default_options_response()
    response.headers['Access-Control-Allow-Methods'] = 'POST'
    response.headers['Access-Control-Allow-Headers'] = 'Content-Type'
    return response


appi.run(debug=True)