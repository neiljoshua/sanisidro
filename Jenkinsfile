pipeline {
  agent any
  stages {
    stage('stage') {
      steps {
        build 'build'
        echo '"deploy success"'
      }
    }

  }
  environment {
    env = 'production'
  }
}