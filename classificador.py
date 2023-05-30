import pandas as pd
import nltk
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.svm import LinearSVC

# Baixe os recursos necessários do NLTK
nltk.download('punkt')
nltk.download('stopwords')

# Carregue o arquivo Excel
df = pd.read_excel('avaliacao.xlsx')

# Pré-processamento de texto
stop_words = set(stopwords.words('portuguese'))

# Função para pré-processar um texto
def preprocess_text(text):
    # Tokenização
    tokens = word_tokenize(text.lower())
    # Remoção de stop words
    tokens = [token for token in tokens if token not in stop_words]
    # Junção dos tokens em uma única string
    preprocessed_text = ' '.join(tokens)
    return preprocessed_text

# Aplicar pré-processamento de texto às colunas de título e avaliação
df['Titulo'] = df['titulo'].apply(preprocess_text)
df['Avaliacao'] = df['avaliacao'].apply(preprocess_text)

# Vetorização usando TF-IDF
vectorizer = TfidfVectorizer()
X_vectorized = vectorizer.fit_transform(df['titulo'] + ' ' + df['avaliacao'])

# Treinamento do classificador SVM
classifier = LinearSVC()
classifier.fit(X_vectorized, df['tipo'])

# Função para classificar uma avaliação
def classify_review(review):
    preprocessed_review = preprocess_text(review)
    review_vectorized = vectorizer.transform([preprocessed_review])
    prediction = classifier.predict(review_vectorized)
    return prediction[0]

# Solicitar avaliação ao usuário
user_review = "É uma empresa mais ou menos, mas o pagamento é em dia"

# Classificar a avaliação
classification = classify_review(user_review)

# Exibir resultado
print("Classificação da avaliação: ", classification)
