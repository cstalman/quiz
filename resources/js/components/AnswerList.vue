<template>
    <div class="container">
        <h2 class="my-4">Beheer antwoorden</h2>
        <div class="answer-list">
            <label for="quiz">Kies een toets</label>
            <select id="quiz" class="form-control" v-model="quizId" @change="fetchQuestions" required>
                <option value="">Kies een toets</option>
                <option v-for="quiz in quizzes" :value="quiz.id" :key="quiz.id">{{quiz.title}}</option>
            </select>
            <label for="question">Vraag</label>
            <select id="question" class="form-control" v-model="questionId" @change="fetchAnswers" required>
                <option value="">Kies een vraag</option>
                <option v-for="question in questions" :value="question.id" :key="question.id">{{question.text}}</option>
            </select>
            <ul class="list-group mt-3">
                <li v-for="answer in answers" :key="answer.id" class="list-group-item">
                    <router-link :to="{name: 'edit-answer', params: {id: answer.id, question: questionId}}">
                        {{answer.text}}
                    </router-link>
                </li>
                <div class="alert alert-primary" v-if="answers.length === 0">Geen antwoorden gevonden</div>
            </ul>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuizzes', 'initialQuestions'],
        data() {
            return {
                quizId: this.initialQuizzes[0].id,
                questionId: this.initialQuestions[0].id,
                quizzes: [],
                questions: [], 
                answers: []
            }
        },
        created() {
            this.fetchQuizzes();
            this.fetchQuestions();
            this.fetchAnswers();
        },
        methods: {
            fetchQuizzes() {
                axios.get('/api/quizzes')
                    .then(res => this.quizzes = res.data);
            },
            fetchQuestions() {
                this.answers = [];
                axios.get(`/api/quizzes/${this.quizId}/questions`)
                    .then(res => this.questions = res.data);
            },
            fetchAnswers() {
                axios.get(`/api/questions/${this.questionId}/answers`)
                    .then(res => this.answers = res.data);
            }
        }
    }
</script>