const timestamp = Date.now();
  const user = {
    name: `Teste ${timestamp}`,
    email: `teste${timestamp}@gmail.com`,
    password: 'teste123',
};
/*
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

    */

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

    /*

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

describe("Cadastro de acessórios", () => {  */
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
    }); /*

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

}); */

describe("Adicionar estoque", () => {
    it('deve cadastrar novos acessórios', () => {
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
        cy.get('#search').type('NYL-552');
        cy.get('#dropdown')
            .should('be.visible')
            .contains('NYL-552')
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
        cy.get('#search').type('NYL-552');
        cy.get('#dropdown')
            .should('be.visible')
            .contains('NYL-552')
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
        cy.visit('/obras');             //REMOVER ESSA PARTE DEPOIS
        cy.visit('/obras/create');
        cy.get('input[name="nome"]')
            .type('OBRA TESTE');
        cy.contains('button', 'Salvar')
            .click();
        cy.contains("Obra cadastrada com sucesso!").should('be.visible');
        cy.visit('/estoque');
        cy.contains('td', 'NYL-552')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('10');
        cy.get('select[name="obra_id"]')
            .select('OBRA TESTE');
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
        cy.contains('td', 'NYL-552')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('0');
        cy.get('select[name="obra_id"]')
            .select('OBRA TESTE');
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
        cy.contains('td', 'NYL-552')
            .closest('tr')
            .find('[data-cy^="retirar-estoque-"]')
            .click();
        cy.get('input[name="quantidade"]')
            .type('1000');
        cy.get('select[name="obra_id"]')
            .select('OBRA TESTE');
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
        cy.contains('td', 'NYL-552')
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
