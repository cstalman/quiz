<template>
    <div class="container">
        <h1>Toetsen</h1>

        <router-view :initial-quizzes="quizzes" :initial-questions="questions"></router-view>

    </div>
</template>

<script>
    import VueRouter from 'vue-router';
    import QuizList from './QuizList.vue';
    import QuizQA from './QuizQA.vue';

    export default {
        props: ['quizzes', 'questions'],       
        router: new VueRouter({
            mode: 'history',
            base: 'quiz-taker',
            routes: [
                {
                    path: '/quizzes',
                    name: 'quizzes',
                    component: QuizList
                },
                {
                    path: '/quiz/:id',
                    name: 'quiz-qa',
                    component: QuizQA,
                    props: true
                },
                {
                    path: '/',
                    redirect: {name: 'quizzes'}
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