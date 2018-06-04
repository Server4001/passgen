#!/usr/bin/env groovy

node('master') {
    try {
        stage('git-pull') {
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
