#!/usr/bin/env groovy

node('master') {
    try {
        stage('build') {
            git url: 'git@github.com:server4001/passgen.git'

            sh "/var/lib/jenkins/composer install"
        }

        stage('test') {
            sh "./vendor/bin/phpunit -c ./phpunit.xml"
            sh "echo 'test'"
        }

    } catch(error) {
        // TODO : Add alerting.
        throw error
    }
}
