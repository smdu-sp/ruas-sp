import faker from 'faker'

context('PreCadastro View', () => {
    beforeEach(() => {
        cy.visit(Cypress.env('host'))
    })

    it('loads the pre-cadastro registration form', () => {
        // Arrange
        const formTitle = 'Cadastrar Estabelecimento'
        // Act
        // Assert
        cy.url().should('contain', '/pre-cadastro')
        cy.contains(formTitle).should('be.visible')
    })

    // it('prevents sending ')
})

context('Cadastrar Estabelecimento', () => {
    beforeEach(() => {
        cy.visit(Cypress.env('host'))
    })

    it('prevents sending empty form', () => {
        // Arrange
        const sendButton = cy.get('button').contains('Enviar')
        // Act
        sendButton.click()
        // Assert
        cy.get('.invalid-feedback').should('have.length.gte', 1)
    })

    it('sends valid form', () => {
        // Arrange
        // const sendButton = cy.get('button').contains('Enviar')
        cy.intercept('/api/cep/*').as('getCep')
        
        // Act
        fillEstabelecimento()
        // Espera resposta da API dos Correios
        cy.wait('@getCep').then((interception) => {
            fillContato()
            cy.get('button').contains('Enviar').click()
        })

        // Assert
        cy.get('#modal-sucesso').should('be.visible')
    })

    const fillEstabelecimento = function() {
        const cnpj = Cypress.env('cnpj')
        const licenca = Cypress.env('licenca_funcionamento')
        cy.get('#cnpj').type(cnpj)
        cy.get('#licenca_funcionamento').type(licenca)
    }

    const fillContato = function() {
        const nome = faker.name.findName()
        const email = faker.internet.email()
        const celular = faker.phone.phoneNumber()

        cy.get('#nome').type(nome)
        // cy.get('#email').type(email)        
        cy.get('#celular').type(celular)        
        confirmEmail()
    }
    
    const confirmEmail = function() {
        cy.get('#email').then(($email) => {
            cy.get('#email-confirm').type($email[0].value)
        })
    }
})
