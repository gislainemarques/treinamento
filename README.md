Desafio 1
1- Projeto em Laravel MySQL Server
2 - Model Pessoa (nome, telefone, email). 
   2.1 - nome - varchar (255)
   2.2 - telefone - varchar (20)
   2.3 - email - varchar (255)
3 - Migration 'create_table_pessoas implementando Soft Deletes
4- Controller e Routes (endpoints) para realizar as operações: CREATE, READ, UPDATE, DELETE (CRUD)

**Problemáticas: **
1 - Não poderá ser feito a operação de cadastro de email repetido. Para isso, deverá ser verificado se o email já existe no banco de dados.
2 - Operação de UPDATE só terá efetividade para os campos de nome e telefone.
3 - Os cadastros deverão ter colunas que armazenarão os dados da data de criação, data de alteração, e data de remoção. (timestamps e soft delete).

Desafio 2
As regras de negócio são as seguinte:
- 1 Pessoa pode ter mais de um Carro (1-n)
- 1 Pessoa não pode registrar o mesmo carro de outra pessoa.

Campos do Model Carro:
- id (bigIncrements)
- pessoa_id (bigIncrements, foreigh Key)
- placa (string)
- cor (string, nullable)
- nome (string)

Estrutura de herança:
Pessoa x Carro (OneToMany) - 1 pessoa para muitos carros

APIs necessárias:
- inserir um novo carro para uma pessoa
- remover um carro de uma pessoa (soft delete)
- buscar proprietário pela placa

*********
