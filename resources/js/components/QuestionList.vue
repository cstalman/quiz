<template>
    <div class="container">
        <h2 class="my-4">Beheer vragen</h2>
        <div class="question-list">
            <label for="quiz">Kies een toets</label>
            <select id="quiz" class="form-control" v-model="quizId" @change="fetchQuestions" required>
                <option value="">Kies een toets</option>
                <option v-for="quiz in quizzes" :value="quiz.id" :key="quiz.id">{{quiz.title}}</option>
            </select>
            <div>{{ feedback }}</div>
            <ul class="list-group mt-3">
                <li v-for="question in questions" :key="question.id" class="list-group-item">
                    <router-link :to="{name: 'edit-question', params: {id: question.id}}">
                        {{question.text}}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuizzes'],
        data() {
            return {
                quizId: this.initialQuizzes[0].id,
                questions: []
            }
        },
        created() {
            this.fetchQuizzes();
            this.fetchQuestions();
        },
        methods: {
            fetchQuizzes() {
                axios.get('/api/quizzes')
                    .then(res => this.quizzes = res.data);
            },
            fetchQuestions() {
                axios.get(`/api/quizzes/${this.quizId}/questions`)
                    .then(res => this.questions = res.data);
            }
        }
    }
</script>