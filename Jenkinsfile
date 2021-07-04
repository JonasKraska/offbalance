pipeline {
    agent any

    tools {
        nodejs 'node-14.16.1'
    }

    parameters {
        string(name: 'HTTPD_PRIVATE', defaultValue: '/customers/e/c/1/offbalance-ballettstudio-stade.de/httpd.private', description: '')
        string(name: 'HTTPD_PUBLIC', defaultValue: '/customers/e/c/1/offbalance-ballettstudio-stade.de/httpd.www', description: '')
    }

    stages {

        stage('build') {
            steps {
                echo 'building the application...'
                sh "bin/composer run build"
            }
        }

        stage('test') {
            steps {
                echo 'testing the application...'
                sh "bin/composer run php:test"
            }
        }

        stage('deploy') {
            // when { branch 'main' }
            steps {
                echo 'deploying the application...'
                sh "bin/composer run deploy:prepare"
                sshPublisher(
                    continueOnError: false, failOnError: true,
                    publishers: [
                        sshPublisherDesc(
                            configName: "offbalance-ssh",
                            verbose: true,
                            transfers: [
                                sshTransfer(execCommand: "/bin/rm -rf ${params.HTTPD_PRIVATE}/**"),
                                sshTransfer(sourceFiles: "**/*", remoteDirectory: "httpd.private", makeEmptyDirs: true),
                                sshTransfer(execCommand: "chmod 775 ${params.HTTPD_PRIVATE}/bin/*"),
                                sshTransfer(execCommand: "cd ${params.HTTPD_PRIVATE} && php bin/composer run deploy"),
                                sshTransfer(execCommand: "/bin/cp -r ${params.HTTPD_PRIVATE}/public/* ${params.HTTPD_PUBLIC}/")
                            ]
                        )
                    ]
                )
            }
        }
    }
}
