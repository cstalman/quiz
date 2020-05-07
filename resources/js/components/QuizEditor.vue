<template>
    <div>
        <router-view :initial-quizzes="quizzes"></router-view>
    </div>
</template>

<script>
import VueRouter from 'vue-router';
import QuizManager from './QuizManager.vue';
import QuestionsQuiz from './QuestionsQuiz.vue';

export default {
    props: ['quizzes', 'questions'], 
    router: new VueRouter({
        mode: 'history',
        base: 'quiz-editor',
        routes: [
            {
                path: '/quizzes',
                name: 'quizzes',
                component: QuizManager
            },
            {
                path: '/',
                redirect: {name: 'quizzes'}
            },
            {
               path: '/questions',
               name: 'questions',
               component: QuestionsQuiz
            },
            {
                path: '*',
                redirect: '/'
            }
        ]
    })    
}
</script>