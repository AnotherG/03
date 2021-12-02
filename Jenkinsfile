pipeline {
    agent any
        stages {
        parallel {
        stage('Initialize') {
            steps {
                //Ensure docker exists
                sh 'which docker-compose || curl -L https://github.com/docker/compose/releases/download/1.29.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose'

                //Ensure docker compose is executable
                sh 'chmod +x /usr/local/bin/docker-compose'
            }
        }
        } 

        

          stage('Build Test-Env') {
            steps {
                sh 'bash bypass.sh'
                sh 'bash compose-run-testing.sh' // Build with Testing Configs

            }
        }

            stage('Code Quality Check via SonarQube') {
                steps {
                    script {
                        def scannerHome = tool 'SonarQube';
                        withSonarQubeEnv('SonarQube') {
                            sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=LabTest -Dsonar.sources=."
                                }
                            }
                        }
                    }
                }  
 post {
    always {
        recordIssues enabledForFailure: true, tool: sonarQube()
        }
    }
}






pipeline {
    agent any

    stages {

      
       
        stage('UI Test') {
            steps {
                echo 'Running UI test'
                sh 'docker-compose exec -T flask-app sh -c "python3 -m unittest -v tests/seleniumtest/test.py"'
            }
        }
        stage('Teardown test environment') {
            steps {
                sh 'docker-compose down'
                sh 'docker system prune -f' // prune all dangling images -f for no confirmation
                sh 'bash revertbypass.sh'
            }
        }
        stage('Deploy') {
            steps {
                sh 'bash compose-run-production.sh' // Deploy with Production Configs
            }
        }
    }
    post {
        success {
            dependencyCheckPublisher pattern: '**/dependency-check-report.xml'
        }
    }
}
