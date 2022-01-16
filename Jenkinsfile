pipeline {
    agent any

    stages {
        stage('Git Clone') {
            steps{
                git branch: 'main', 
                credentialsId: 'github_credential', 
                url: 'https://github.com/phokhaing/deploy_devops_hr_system.git'
            }
        }
        
        stage('Allow permision dir'){
            steps{
                sh "sudo chmod -R 777 ."
            }
        }
        
        stage('Docker build'){
            steps{
                sh "sed -i \"s/TAG_VERSION/$BUILD_NUMBER/g\" docker-compose.yaml"
                sh "docker-compose build"
            }
        }
        
        stage('Push Image to Docker Hub'){
            steps{
                echo "Push phokhaing/hr_system_app to docker hub"
                withCredentials([string(credentialsId: 'dockerhub_credential', variable: 'dockerhub_pwd')]) {
                    sh 'docker login -u phokhaing -p $dockerhub_pwd'
                }
                sh "docker push phokhaing/hr_system_app:$BUILD_NUMBER"
            }
        }
        stage('Deploy on kubernetes cluster'){
            environment {
                ssh_master1 = 'ubuntu@172.20.2.81'
                ssh_master1_dir = 'ubuntu@172.20.2.81:/home/ubuntu'
            }
            steps{
                sshagent(['kube_master1']) {
                    echo "copy deploy files into server kubernetes_master"
                    sh "scp -o StrictHostKeyChecking=no app-deploy.yaml $ssh_master1_dir"
                    
                    echo "use sed to find and replace text TAG_VERSION"
                    sh "ssh $ssh_master1 sed -i \"s/TAG_VERSION/$BUILD_NUMBER/g\" app-deploy.yaml"
                    
                    echo "Deploy Application"
                    script{
                        try{
                            sh "ssh $ssh_master1 kubectl apply -f app-deploy.yaml"
                        }catch(error){
                            echo "Deploy Database"
                            sh "ssh $ssh_master1 kubectl create -f app-deploy.yaml"
                        }
                    }
                }
            }
        }
        
    }
    
    // Slack notifier
    post {
        // only triggered when blue or green sign
        success {
            slackSend teamDomain: 'g7devops',
            channel: 'hr-system', 
            tokenCredentialId: 'slack_credential',
            color: 'good',
            message: "Build Started: `${env.JOB_NAME}` #${env.BUILD_NUMBER}:\n${env.BUILD_URL}\nSatus: SUCCESS"
        }
        // triggered when red sign
        failure {
            slackSend teamDomain: 'g7devops',
            channel: 'hr-system', 
            tokenCredentialId: 'slack_credential',
            color: 'danger',
            message: "Build Started: `${env.JOB_NAME}` #${env.BUILD_NUMBER}:\n${env.BUILD_URL}\nSatus: FAILE"
        }
    }
}
