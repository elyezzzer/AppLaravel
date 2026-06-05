import './commands';

Cypress.on('uncaught:exception', (err, runnable) => {
  // Prevent Cypress from failing on unrelated frontend exceptions
  return false;
});
