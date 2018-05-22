#!/usr/bin/env groovy

node('master') {
    try {
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

        stage('ant-command') {
            step([
                withAnt(installation: 'Ant v1.7.1') {
                    dir(".") {
                        sh "ant -f /vagrant/ant-build-scripts/hello-world.xml main"
                    }
                }
            ])
        }

    } catch(error) {
        // TODO : Add alerting.
        throw error
    }
}
