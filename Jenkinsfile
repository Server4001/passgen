#!/usr/bin/env groovy

node('master') {
    properties([
        [
            $class: 'BuildDiscarderProperty',
            strategy: [
                $class: 'LogRotator',
                artifactDaysToKeepStr: '',
                artifactNumToKeepStr: '',
                daysToKeepStr: '',
                numToKeepStr: '10'
            ]
        ]
    ]);

    try {
        stage('git-pull') {
            git url: 'git@github.com:Server4001/passgen.git', credentialsId: 'github-server4001-key'
            echo "Branch name: ${env.BRANCH_NAME}"
        }

        stage('build') {
            sh "/var/lib/jenkins/composer install"
        }

        stage('test') {
            sh "./vendor/bin/phpunit -c ./phpunit.xml --coverage-clover ./tests/clover-coverage-report.xml --log-junit ./tests/phpunit-tests-output.xml"
        }

        stage('xunit-test-result-report'){
            step([
                $class: 'XUnitBuilder',
                thresholds: [[$class: 'FailedThreshold', unstableThreshold: '1']],
                tools: [[$class: 'JUnitType', pattern: 'tests/phpunit-tests-output.xml']]
            ])
            publishHTML([allowMissing: false, alwaysLinkToLastBuild: false, keepAll: false, reportDir: './tests/coverage', reportFiles: 'index.html', reportName: 'Coverage Report', reportTitles: ''])
        }

        stage('generate-code-coverage') {
            step([
                $class: 'CloverPublisher',
                cloverReportDir: 'tests/',
                cloverReportFileName: 'clover-coverage-report.xml',
                healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80],
                unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50],
                failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
            ])
        }

    } catch(error) {
        // TODO : Add alerting.
        throw error
    }
}
