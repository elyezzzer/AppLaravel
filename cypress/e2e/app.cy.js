const timestamp = Date.now();
  const user = {
    name: `Teste ${timestamp}`,
    email: `teste${timestamp}@gmail.com`,
    password: 'teste123',
}; 

describe('Cadastro e Login', () => {
    it('deve bloquear login com email inválido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type('usuarioinvalido@gmail.com');
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.contains('credenciais não foram encontradas')
            .should('be.visible');
        cy.url()
        .should('include', '/login');
    });

    it('deve bloquear login com senha inválida', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type('senhaerrada123');
        cy.get('button[type="submit"]')
            .click();
        cy.contains('credenciais não foram encontradas')
            .should('be.visible');
        cy.url()
        .should('include', '/login');
    });

    it('deve cadastrar usuário', () => {
        cy.visit('/register');
        cy.get('#name')
        .type(user.name);
        cy.get('#email')
        .type(user.email);
        cy.get('#password')
        .type(user.password);
        cy.get('#password_confirmation')
        .type(user.password);
        cy.get('button[type="submit"]')
        .click();
        cy.url()
        .should('include', '/home');
    });

    it('deve fazer login', () => {
        cy.visit('/login');
        cy.get('#email')
        .type(user.email);
        cy.get('#password')
        .type(user.password);
        cy.get('button[type="submit"]')
        .click();
        cy.url()
        .should('include', '/home');
    }); 

    it('deve manter o login após recarregar ou reabrir a página', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.reload();
        cy.visit('/home');
        cy.url().should('include', '/home');
    });

    it('deve alterar o nome de usuario para "Nome alterado".', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/profile');
        cy.get('#name').clear().type('Nome alterado');
        cy.contains("button", "Salvar").click()
        cy.contains('Nome alterado').should('be.visible');
    
    });
}); 

describe("Acessórios", () => {  
    it('deve cadastrar novos acessórios', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.visit('/acessorios/create');
        cy.get('input[name="codigo"]')
            .type('NYL-552');
        cy.get('input[name="descricao"]')
            .type('TAMPA FURO 10MM');
        cy.get('select[name="cor"]')
            .select('TODAS');
        cy.get('input[name="estoque_minimo"]')
            .type('10');
        cy.get('input[name="preco"]')
            .type('0.10');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Acessório cadastrado com sucesso!").should('be.visible');
        cy.visit('/acessorios/create');
        cy.get('input[name="codigo"]')
            .type('FRA-600');
        cy.get('input[name="descricao"]')
            .type('MULTIPONTO EM INOX SEM CHAVE 600MM');
        cy.get('select[name="cor"]')
            .select('TODAS');
        cy.get('input[name="estoque_minimo"]')
            .type('1');
        cy.get('input[name="preco"]')
            .type('60');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Acessório cadastrado com sucesso!").should('be.visible');
        cy.visit('/acessorios/create');
        cy.get('input[name="codigo"]')
            .type('FEC-508');
        cy.get('input[name="descricao"]')
            .type('CREMONA DUPLA');
        cy.get('select[name="cor"]')
            .select('TODAS');
        cy.get('input[name="estoque_minimo"]')
            .type('10');
        cy.get('input[name="preco"]')
            .type('34');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Acessório cadastrado com sucesso!").should('be.visible');
    }); 

    it('deve exibir erro ao cadastrar acessório com código duplicado', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.visit('/acessorios/create');
        cy.get('input[name="codigo"]')
            .type('NYL-552');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Este código já está cadastrado.").should('be.visible');
    });

    it('deve exibir erro ao cadastrar acessório com descrição em branco', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.visit('/acessorios/create');
        cy.get('input[name="descricao"]')
            .type(' ');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("A descrição é obrigatória.").should('be.visible');
    });

    it('deve exibir erro ao cadastrar acessório com preço inválido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.visit('/acessorios/create');
        cy.get('input[name="preco"]')
            .type('-0.10');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("O preço não pode ser negativo.").should('be.visible');
    });

    it('deve exibir erro ao cadastrar acessório com estoque mínimo inválido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.visit('/acessorios/create');
        cy.get('input[name="estoque_minimo"]')
            .type('-10');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("O estoque mínimo não pode ser negativo.").should('be.visible');
    });

    it('deve editar acessório', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.contains('NYL-552')
            .closest('tr')
            .find('[data-cy="editar-acessorio"]')
            .click();
        cy.get('input[name="descricao"]')
            .clear()
            .type('EDITADO');
        cy.contains('button', 'Atualizar')
            .click();
        cy.contains("Acessório atualizado com sucesso!").should('be.visible');
    });

    it('deve exibir erro ao editar acessório com campos em branco', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.contains('NYL-552')
            .closest('tr')
            .find('[data-cy="editar-acessorio"]')
            .click();
        cy.get('input[name="descricao"]')
            .clear()
            .type(' ');
        cy.get('input[name="preco"]')
            .clear()
            .type(' ');
        cy.get('input[name="estoque_minimo"]')
            .clear()
            .type(' ');
        cy.get('input[name="codigo"]')
            .clear()
            .type(' ');
        cy.contains('button', 'Atualizar')
            .click();
        cy.contains("A descrição é obrigatória").should('be.visible');
        cy.contains("O preço é obrigatório").should('be.visible');
        cy.contains("O estoque mínimo é obrigatório").should('be.visible');
        cy.contains("O código é obrigatório").should('be.visible');
    });

    it('deve exibir erro ao editar acessório com preço/estoque mínimo negativo', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.contains('NYL-552')
            .closest('tr')
            .find('[data-cy="editar-acessorio"]')
            .click();
        cy.get('input[name="preco"]')
            .clear()
            .type('-0.1');
        cy.get('input[name="estoque_minimo"]')
            .clear()
            .type('-1');
        cy.contains('button', 'Atualizar')
            .click();
        cy.contains("O preço não pode ser negativo.").should('be.visible');
        cy.contains("O estoque mínimo não pode ser negativo.").should('be.visible');
    });

    it('deve exibir erro ao editar acessório com código duplicado', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.contains('NYL-552')
            .closest('tr')
            .find('[data-cy="editar-acessorio"]')
            .click();
        cy.get('input[name="codigo"]')
            .clear()
            .type('FRA-600');
        cy.contains('button', 'Atualizar')
            .click();
        cy.contains("Este código já está cadastrado.").should('be.visible');
    });

    it('deve excluir um acessorio', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/acessorios');
        cy.contains('td', 'NYL-552')
            .closest('tr')
            .find('[data-cy="excluir-acessorio"]')
            .click({ force: true });
        cy.get('[data-cy="confirmar-exclusao"]')
            .filter(':visible')
            .click();
        cy.contains("Acessório excluído com sucesso!").should('be.visible');
    });
});    

describe("Obras", () => {
    it('deve cadastrar novas obras', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.visit('/obras/create');
        cy.get('input[name="nome"]')
            .type('OBRA TESTE');
        cy.get('input[name="cidade"]')
            .type('CIDADE TESTE');
        cy.get('input[name="bairro"]')
            .type('BAIRRO TESTE');
        cy.get('input[name="rua"]')
            .type('RUA TESTE');
        cy.get('input[name="numero"]')
            .type('1000');
        cy.get('input[name="telefone"]')
            .type('4299999999');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-09');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Obra cadastrada com sucesso!").should('be.visible');
        cy.visit('/obras');             
        cy.visit('/obras/create');
        cy.get('input[name="nome"]')
            .type('OBRA TESTE 2');
        cy.get('input[name="cidade"]')
            .type('CIDADE TESTE');
        cy.get('input[name="bairro"]')
            .type('BAIRRO TESTE');
        cy.get('input[name="rua"]')
            .type('RUA TESTE');
        cy.get('input[name="numero"]')
            .type('1000');
        cy.get('input[name="telefone"]')
            .type('4299999999');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-09');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Obra cadastrada com sucesso!").should('be.visible');
    });

    it('deve exibir erro ao cadastrar obra com nome repetido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.visit('/obras/create');
        cy.get('input[name="nome"]')
            .type('OBRA TESTE');
        cy.get('input[name="cidade"]')
            .type('CIDADE TESTE');
        cy.get('input[name="bairro"]')
            .type('BAIRRO TESTE');
        cy.get('input[name="rua"]')
            .type('RUA TESTE');
        cy.get('input[name="numero"]')
            .type('1000');
        cy.get('input[name="telefone"]')
            .type('4299999999');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-09');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Já existe uma obra com nome igual ou muito parecido.").should('be.visible');
    });

    it('deve exibir erro ao cadastrar obra com o nome vazio', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.visit('/obras/create');
        cy.get('input[name="nome"]')
            .type(' ');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("O nome da obra é obrigatório.").should('be.visible');
    });

    it('deve editar uma obra existente', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.get('[data-cy="editar-obra"]')
            .should('exist')
            .first()
            .click();
        cy.get('input[type="text"]')
            .first()
            .clear()
            .type('OBRA EDITADA');
        cy.contains('button', 'Atualizar obra')
            .click();
        cy.contains("Obra atualizada com sucesso!").should('be.visible');  
    });

    it('deve exibir mensagem de erro ao editar obra com nome vazio', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.get('[data-cy="editar-obra"]')
            .should('exist')
            .first()
            .click();
        cy.get('input[type="text"]')
            .first()
            .clear()
            .type(' ');
        cy.contains('button', 'Atualizar obra')
            .click();
        cy.contains("O nome da obra é obrigatório.").should('be.visible');
    });

    it('deve exibir mensagem de erro ao editar obra com nome já existente', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.get('[data-cy="editar-obra"]')
            .should('exist')
            .first()
            .click();
        cy.get('input[type="text"]')
            .first()
            .clear()
            .type('OBRA TESTE 2');
        cy.contains('button', 'Atualizar obra')
            .click();
        cy.contains("Já existe uma obra com nome igual ou muito parecido.").should('be.visible');
    });

    it('deve excluir uma obra', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/obras');             
        cy.get('[data-cy="excluir-obra"]')
            .should('exist')
            .eq(1)
            .click();
        cy.get('[data-cy="confirmar-exclusao-obra"]')
            .filter(':visible')
            .click();
        cy.contains("Obra excluída!").should('be.visible');
    });
});

describe("Estoque", () => {
    it('deve adicionar estoque', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.visit('/estoque/create');
        cy.get('#search').type('FEC');
        cy.get('#dropdown')
            .should('be.visible')
            .contains('FEC-508')
            .click();
        cy.get('select[name="cor"]')
            .select('PRETO');
        cy.get('input[name="quantidade"]')
            .type('100');
        cy.contains('button', 'Adicionar ao estoque')
            .click();
        cy.contains("Estoque atualizado com sucesso!").should('be.visible');
    }); 

    it('deve exibir erro ao adicionar estoque com quantidade negativa', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.visit('/estoque/create');
        cy.get('#search').type('FEC');
        cy.get('#dropdown')
            .should('be.visible')
            .contains('FEC-508')
            .click();
        cy.get('select[name="cor"]')
            .select('PRETO');
        cy.get('input[name="quantidade"]')
            .type('-10');
        cy.contains('button', 'Adicionar ao estoque')
            .click();
        cy.contains("A quantidade deve ser superior a 0.").should('be.visible');
    });
    
    it('deve exibir erro ao tentar adicionar estoque com código inválido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.visit('/estoque/create');
        cy.get('#search').type('CODIGO-INVALIDO');
        cy.get('select[name="cor"]')
            .select('PRETO');
        cy.get('input[name="quantidade"]')
            .type('23');
        cy.contains('button', 'Adicionar ao estoque')
            .click();
        cy.contains("O código é obrigatório.").should('be.visible');
    });

    it('deve exibir botão de cadastro ao tentar adicionar um código inválido', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.visit('/estoque/create');
        cy.get('#search').type('CODIGO-INVALIDO');
        cy.get('select[name="cor"]')
            .select('PRETO');
        cy.contains("Cadastrar novo acessório").should('be.visible');
    });

    it('deve exibir botão de cadastro ao tentar adicionar um código inválido e direcionar para a página de cadastro', () => {
        cy.visit('/login');
        cy.get('#email')
            .type(user.email);
        cy.get('#password')
            .type(user.password);
        cy.get('button[type="submit"]')
            .click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.visit('/estoque/create');
        cy.get('#search').type('CODIGO-INVALIDO');
        cy.get('select[name="cor"]')
            .select('PRETO');
        cy.contains("Cadastrar novo acessório").should('be.visible')
            .click();
        cy.url().should('include', '/acessorios/create');  
    });

    it('deve realizar uma retirada', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.contains('td', 'FEC-508')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('10');
        cy.get('select[name="obra_id"]')
            .select('OBRA EDITADA');
        cy.contains('button', 'Confirmar retirada')
            .click();
        cy.contains("Retirada realizada!").should('be.visible');
    });

    it('deve exibir erro ao tentar realizar uma retirada com quantidade inválida', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.contains('td', 'FEC-508')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('0');
        cy.get('select[name="obra_id"]')
            .select('OBRA EDITADA');
        cy.contains('button', 'Confirmar retirada')
            .click();
        cy.contains("A quantidade deve ser superior a 0.").should('be.visible');
    });

    it('deve exibir erro ao tentar realizar uma retirada com quantidade maior que a disponível', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.contains('td', 'FEC-508')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('1000');
        cy.get('select[name="obra_id"]')
            .select('OBRA EDITADA');
        cy.contains('button', 'Confirmar retirada')
            .click();
        cy.contains("Quantidade maior que o estoque.").should('be.visible');
    });

    it('deve exibir erro ao tentar realizar uma retirada com o campo de obra em branco', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/estoque');
        cy.contains('td', 'FEC-508')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('10');
        cy.contains('button', 'Confirmar retirada')
            .click();
        cy.contains("A obra é obrigatória.").should('be.visible');
    });
});

describe("Historico", () => {
    it('deve filtrar o historico por saida', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('input[name="search"]')
            .type('Saida');
        cy.contains('button', 'Buscar')
            .click();
        cy.get('tbody tr').each(($row) => {
        cy.wrap($row)
            .should('not.contain', 'ENTRADA');
        });
    });

    it('deve filtrar o historico por entrada', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('input[name="search"]')
            .type('Entrada');
        cy.contains('button', 'Buscar')
            .click();
        cy.get('tbody tr').each(($row) => {
        cy.wrap($row)
            .should('not.contain', 'SAIDA');
        });
    });

    it('deve filtrar o historico por obra que existe', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('select[name="filtro"]')
            .select('obra');
        cy.get('input[name="search"]')
            .type('OBRA EDITADA');
        cy.contains('button', 'Buscar')
            .click();
        cy.contains('td', 'OBRA EDITADA').should('be.visible');
    });

    it('deve filtrar o historico por obra que não existe', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('select[name="filtro"]')
            .select('obra');
        cy.get('input[name="search"]')
            .type('OBRA INEXISTENTE');
        cy.contains('button', 'Buscar')
            .click();
        cy.contains('Nenhuma movimentação encontrada').should('be.visible');
    });

    it('deve filtrar o historico por cor que existe', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('select[name="filtro"]')
            .select('cor');
        cy.get('input[name="search"]')
            .type('Preto');
        cy.contains('button', 'Buscar')
            .click();
    });

    it('deve filtrar o historico por cor que não existe', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/historico');
        cy.get('select[name="filtro"]')
            .select('cor');
        cy.get('input[name="search"]')
            .type('COR INEXISTENTE');
        cy.contains('button', 'Buscar')
            .click();
        cy.contains('Nenhuma movimentação encontrada').should('be.visible'); 
    });
});

describe("Relatórios", () => {
    it('deve gerar relatório de entrada', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('select[id="tipo_relatorio"]')
            .select('Entrada');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.contains('button', 'Gerar relatório')
            .click();
            cy.url().should('include', '/relatorios');
            cy.contains('Relatório gerado com sucesso!').should('be.visible');
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .invoke('attr', 'href')
            .then((href) => {
                cy.request(href).then((response) => {
                    expect(response.status).to.eq(200);
                    expect(response.headers['content-type'])
                        .to.include('application/pdf');
                });
            });
    });

    it('deve gerar relatório de saida', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('select[id="tipo_relatorio"]')
            .select('Saída');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.contains('button', 'Gerar relatório')
            .click();
            cy.url().should('include', '/relatorios');
            cy.contains('Relatório gerado com sucesso!').should('be.visible');
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .invoke('attr', 'href')
            .then((href) => {
                cy.request(href).then((response) => {
                    expect(response.status).to.eq(200);
                    expect(response.headers['content-type'])
                        .to.include('application/pdf');
                });
            });
    });

    it('deve gerar relatório de saida/entrada', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.contains('button', 'Gerar relatório')
            .click();
            cy.url().should('include', '/relatorios');
            cy.contains('Relatório gerado com sucesso!').should('be.visible');
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .invoke('attr', 'href')
            .then((href) => {
                cy.request(href).then((response) => {
                    expect(response.status).to.eq(200);
                    expect(response.headers['content-type'])
                        .to.include('application/pdf');
                });
            });
    });

    it('deve gerar relatório de estoque atual', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('#tipo_relatorio')
            .select('estoque');
        cy.contains('button', 'Gerar relatório')
            .click();
            cy.url().should('include', '/relatorios');
            cy.contains('Relatório gerado com sucesso!').should('be.visible');
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .invoke('attr', 'href')
            .then((href) => {
                cy.request(href).then((response) => {
                    expect(response.status).to.eq(200);
                    expect(response.headers['content-type'])
                        .to.include('application/pdf');
                });
            });
    });

    it('deve gerar relatório de obra', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('select[id="tipo_relatorio"]')
            .select('Obra');
        cy.get('select[name="obra_id"]')
            .select('OBRA EDITADA');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.contains('button', 'Gerar relatório')
            .click();
        cy.url().should('include', '/relatorios');
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="visualizar-relatorio"]')
            .first()
            .invoke('attr', 'href')
            .then((href) => {
                cy.request(href).then((response) => {
                    expect(response.status).to.eq(200);
                    expect(response.headers['content-type'])
                        .to.include('application/pdf');
                });
            });
    });

    it('deve gerar erro ao tentar gerar relatório sem selecionar data inicial', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.contains('button', 'Gerar relatório')
            .click();
        cy.url().should('include', '/relatorios');
        cy.contains('A data inicial é obrigatória.').should('be.visible');
    });

    it('deve gerar erro ao tentar gerar relatório sem selecionar data final', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.get('#data_fim')
            .invoke('val', '')
            .trigger('input')
            .trigger('change');
        cy.contains('button', 'Gerar relatório')
            .click();
        cy.contains('A data final é obrigatória.').should('be.visible');
    });

    it('deve gerar erro ao tentar gerar relatório sem selecionar obra', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.visit('/relatorios/create');
        cy.get('select[id="tipo_relatorio"]')
            .select('Obra');
        cy.get('input[name="data_inicio"]')
            .type('2026-06-01');
        cy.contains('button', 'Gerar relatório')
            .click();
        cy.contains('Selecione uma obra.').should('be.visible');
    });

    it('deve excluir um relatório', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.get('[data-cy="excluir-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="confirmar-exclusao-relatorio"]')
            .filter(':visible')
            .click();
        cy.contains("Relatório deletado com sucesso!").should('be.visible');
    });

    it('deve fazer download de um relatório', () => {
        cy.visit('/login');
        cy.get('#email').type(user.email);
        cy.get('#password').type(user.password);
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/home');
        cy.visit('/relatorios');
        cy.get('[data-cy="download-relatorio"]')
            .first()
            .should('exist')
            .invoke('removeAttr', 'target')
            .click();
        cy.get('[data-cy="download-relatorio"]')
            .invoke('attr', 'href')
            .then(href => {
                cy.request(href).its('status').should('eq', 200);
            });
    });
});