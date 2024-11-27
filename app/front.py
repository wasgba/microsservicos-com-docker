from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)

# Configuração do banco de dados MySQL
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://user:password@db/supermercado'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

# Modelo de Produto
class Produto(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nome = db.Column(db.String(100), nullable=False)
    preco = db.Column(db.Float, nullable=False)

# Endpoints
@app.route('/produtos', methods=['POST'])
def cadastrar_produto():
    data = request.get_json()
    nome = data.get('nome')
    preco = data.get('preco')

    if not nome or not preco:
        return jsonify({"message": "Nome e preço são obrigatórios"}), 400

    novo_produto = Produto(nome=nome, preco=preco)
    db.session.add(novo_produto)
    db.session.commit()
    
    return jsonify({"message": "Produto cadastrado com sucesso!"}), 201

@app.route('/produtos', methods=['GET'])
def listar_produtos():
    produtos = Produto.query.all()
    return jsonify([{"id": p.id, "nome": p.nome, "preco": p.preco} for p in produtos])

@app.route('/produtos/<int:id>', methods=['PUT'])
def atualizar_produto(id):
    data = request.get_json()
    produto = Produto.query.get(id)
    
    if not produto:
        return jsonify({"message": "Produto não encontrado"}), 404
    
    produto.nome = data.get('nome', produto.nome)
    produto.preco = data.get('preco', produto.preco)
    db.session.commit()
    
    return jsonify({"message": "Produto atualizado com sucesso"})

@app.route('/produtos/<int:id>', methods=['DELETE'])
def excluir_produto(id):
    produto = Produto.query.get(id)
    
    if not produto:
        return jsonify({"message": "Produto não encontrado"}), 404
    
    db.session.delete(produto)
    db.session.commit()
    
    return jsonify({"message": "Produto excluído com sucesso"})

if __name__ == '__main__':
    db.create_all()  # Cria as tabelas no banco de dados, se não existirem
    app.run(host='0.0.0.0', port=5000)

