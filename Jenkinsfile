#!/usr/bin/env groovy

node('master') {
    try {
        stage('git-pull') {
            // Remove the origin/ portion of $Branch in case this was built via parameters,
            // and not via automation against the master branch.
            def branch_formatted = Branch.replaceFirst(/.+\//, "")
            git url: 'git@github.com:Server4001/passgen.git', credentialsId: 'github-server4001-key', branch: "${branch_formatted}"
        }

        stage('build') {
            sh "/var/lib/jenkins/composer install"
        }

        stage('test') {
            sh "./vendor/bin/phpunit -c ./phpunit.xml --coverage-clover ./tests/clover-coverage-report.xml --log-junit ./tests/phpunit-tests-output.xml"
        }

    } catch(error) {
        // TODO : Add alerting.
        throw error
    }
}
