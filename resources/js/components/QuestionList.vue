<template>
    <div class="container">
        <h2 class="my-4">Beheer vragen</h2>
        <div class="question-list">
            <label for="quiz">Kies een toets</label>
            <select id="quiz" class="form-control" v-model="quizId" @change="fetchQuestions" required>
                <option value="">Kies een toets</option>
                <option v-for="quiz in quizzes" :value="quiz.id" :key="quiz.id">{{quiz.title}}</option>
            </select>
            <ul class="list-group mt-3">
                <li v-for="(question, index) in questions" :key="question.id" class="list-group-item">
                     <div class="float-left">
                         <router-link :to="{name: 'edit-question', params: {id: question.id}}">
                            {{question.text}}
                        </router-link>
                     </div>
                     <div class="float-right">
                        <a @click="removeQuestion(index)" class="btn btn-primary d-inline-block mb-2 ml-2 text-white"><i class="fa fa-times-circle"></i> Verwijderen</a>
                    </div>
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
                quizzes: [],
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
            },
            removeQuestion(index) {
               if (confirm('Weet je het zeker?')) {
                   let id = this.questions[index].id
                   if (id > 0) {
                       axios.delete('/api/questions/' + id);
                   }
                   this.questions.splice(index, 1);
               }
            },
        }
    }
</script>