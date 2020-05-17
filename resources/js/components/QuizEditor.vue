<template>
    <div class="container">
        <h1>Toets Editor</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'quizzes'}">Toetsen</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'questions'}">Vragen</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'add-question'}">Vraag toevoegen</router-link>
            </li>
             <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'answers'}">Antwoorden</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name: 'add-answer'}">Antwoord toevoegen</router-link>
            </li>
            </ul>
        <router-view :initial-quizzes="quizzes" :initial-questions="questions"></router-view>

    </div>
</template>

<script>
    import VueRouter from 'vue-router';
    import QuizManager from './QuizManager.vue';
    import QuestionsQuiz from './QuestionsQuiz.vue';
    import QuestionList from './QuestionList.vue';
    import Answer from './Answer.vue';
    import AnswerList from './AnswerList.vue';

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
                    component: QuestionList
                },
                {
                    path: '/add-question',
                    name: 'add-question',
                    component: QuestionsQuiz
                },
                {
                    path: '/edit-question/:id',
                    name: 'edit-question',
                    component: QuestionsQuiz,
                    props: true
                },
                {
                    path: '/answers',
                    name: 'answers',
                    component: AnswerList
                },
                {
                    path: '/add-answer',
                    name: 'add-answer',
                    component: Answer
                },
                {
                    path: '/edit-answer/:id',
                    name: 'edit-answer',
                    component: Answer,
                    props: true
                },
                {
                    path: '*',
                    redirect: '/'
                }
            ]
        })

    }


</script>

<style scoped>
    a {
        border: solid 1px #dee2e6;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        padding: 10px;
        margin: 0;
    }

    .menu-div {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: -5px;
        display: flex;
        flex-wrap: wrap;
    }

    .router-link-active {
        color: black;
        border-color: #dee2e6 #dee2e6 #f8fafc !important;
    }
    
</style>