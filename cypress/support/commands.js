Cypress.Commands.add('register', ({ name, email, password }) => {
  cy.visit('/register');
  cy.get('#name').clear().type(name);
  cy.get('#email').clear().type(email);
  cy.get('#password').clear().type(password);
  cy.get('#password_confirmation').clear().type(password);
  cy.get('button[type="submit"]').click();
});

Cypress.Commands.add('login', ({ email, password, remember = false }) => {
  cy.visit('/login');
  cy.get('#email').clear().type(email);
  cy.get('#password').clear().type(password);
  if (remember) {
    cy.get('#remember_me').check({ force: true });
  }
  cy.get('button[type="submit"]').click();
});

Cypress.Commands.add('logout', () => {
  cy.visit('/home');
  cy.get('form[action="/logout"]').should('exist').submit();
});

Cypress.Commands.add('assertProtectedRoute', (path) => {
  cy.visit(path);
  cy.location('pathname').should('include', '/login');
});

Cypress.Commands.add('fillAccessoryForm', ({ codigo, descricao, cor, estoque_minimo, preco }) => {
  if (codigo !== undefined) {
    cy.get('input[name="codigo"]').clear().type(codigo);
  }
  if (descricao !== undefined) {
    cy.get('input[name="descricao"]').clear().type(descricao);
  }
  if (cor !== undefined) {
    cy.get('select[name="cor"]').select(cor);
  }
  if (estoque_minimo !== undefined) {
    cy.get('input[name="estoque_minimo"]').clear().type(String(estoque_minimo));
  }
  if (preco !== undefined) {
    cy.get('input[name="preco"]').clear().type(String(preco));
  }
});

Cypress.Commands.add('createAccessory', (accessory) => {
  cy.visit('/acessorios/create');
  cy.fillAccessoryForm(accessory);
  cy.contains('button', 'Salvar').click();
});
