pipeline {
    agent any
        stages {

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
        recordIssues enabledForFailure: true, tool: SonarQube()
        }
    }
}