import faker from 'faker'

context('PreCadastro View', () => {
    beforeEach(() => {
        cy.server()
        cy.visit(Cypress.env('host'))
        cy.intercept('GET', '**/api/cnpj*', { fixture: 'cnpj.json' })
        cy.intercept('GET', '**/api/cep*', { fixture: 'cep.json' })
    })

    it('loads the pre-cadastro registration form', () => {
        // Arrange
        const formTitle = 'Cadastrar Estabelecimento'

        // Assert
        cy.url().should('contain', '/pre-cadastro')
        cy.contains(formTitle).should('be.visible')
        cy.get('#razao_social').should('be.disabled')
        cy.get('#endereco').should('be.disabled')
    })
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
        cy.get('.invalid-feedback')
            .should('have.length.gte', 1)
    })

    it('enables manual `razao_social` input when CNPJ cannot be resolved', () => {
        // Arrange
        cy.intercept('GET', '**/api/cnpj/*', { statusCode: 404 }).as('getCnpj')

        // Act
        fillEstabelecimento()

        // Assert
        cy.wait('@getCnpj').then(() => {
            cy.get('#razao_social')
                .should('be.enabled')
        })

    })

    it('enables manual `endereco` input when CEP cannot be resolved', () => {
        // Arrange
        cy.intercept('GET', '**/api/cnpj/*', { fixture: 'cnpj.json' })
        cy.intercept('GET', '**/api/cep/*', { statusCode: 404 }).as('getCep')

        // Act
        fillEstabelecimento()

        // Assert
        cy.wait('@getCep').then(() => {
            cy.get('#endereco').should('be.enabled')
        })

    })

    it('throws an error when trying to register a duplicated Estabelecimento', () => {
        // Arrange
        cy.intercept('GET', '**/api/cnpj/*', { fixture: 'cnpj.json' })
        cy.intercept('GET', '**/api/cep/*', { fixture: 'cep.json' }).as('getCep')
        cy.intercept('POST', '**/api/estabelecimento/store', { fixture: 'store_error_cnpj.json' })

        // Act
        fillEstabelecimento()
        cy.wait('@getCep').then(() => {
            fillContato()
            cy.get('button').contains('Enviar').click()
        })

        // Assert
        cy.get('#modal-erro')
            .should('be.visible')
        cy.contains('Estabelecimento já cadastrado')
            .should('be.visible')
    })

    it('sends valid form', () => {
        // Arrange
        cy.intercept('GET', '**/api/cnpj/*', { fixture: 'cnpj.json' })
        cy.intercept('GET', '**/api/cep/*', { fixture: 'cep.json' }).as('getCep')
        cy.intercept('POST', '**/api/estabelecimento/store', { fixture: 'store_success.json' })

        // Act
        fillEstabelecimento()
        cy.wait('@getCep').then(() => {
            fillContato()
            cy.get('button').contains('Enviar').click()
        })

        // Assert
        cy.get('#modal-sucesso')
            .should('be.visible')
    })

    const fillEstabelecimento = function () {
        const cnpj = Cypress.env('cnpj')
        const licenca = Cypress.env('licenca_funcionamento')
        cy.get('#cnpj').type(cnpj)
        cy.get('#licenca_funcionamento').type(licenca)
    }

    const fillContato = function () {
        const nome = faker.name.findName()
        const email = faker.internet.email()
        const celular = faker.phone.phoneNumber()

        cy.get('#nome').type(nome)
        // cy.get('#email').type(email)        
        cy.get('#celular').type(celular)
        confirmEmail()
    }

    const confirmEmail = function () {
        cy.get('#email').then(($email) => {
            cy.get('#email-confirm').type($email[0].value)
        })
    }
})
