<template>
    <div class="container">
        <h2 class="my-4">Vraag</h2>
        <form class="question-form" @submit.prevent="save">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="question_text">Vraagtekst</label>
                    <input type="text" class="form-control" id="question_text" v-model="question.text" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="question_order">Volgorde</label>
                    <input type="number" class="form-control" id="question_order" min="1" v-model="question.display_order" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="quiz">Toets</label>
                    <select id="quiz" class="form-control" v-model="question.quiz_id" required>
                        <option value="">Kies een toets</option>
                        <option v-for="quiz in initialQuizzes" :value="quiz.id" :key="quiz.id">{{quiz.title}}</option>
                    </select>
                </div>
            </div>      
            <button type="submit" class="btn btn-primary d-inline-block mb-2 text-white"><i class="fa fa-check-circle"></i> Opslaan</button>
            <ul>
                <li v-for="(error, index) in errors" :key="index">{{error}}</li>
            </ul>
        </form>
    </div>
</template>

<script>

    function newQuestion() {
        return {
            quiz_id: '',
            text: '',
            display_order: ''
        };
    }

    export default {
        props: ['initial-quizzes', 'id'],
        data() {
            return {
                question: newQuestion(),
                errors: []
            };
        },
        created() {
            if(this.id) {
                axios.get('/api/questions/' + this.id)
                    .then(res => this.question = res.data);
            }
        },
        beforeRouteLeave(to, from, next) {
            this.question = newQuestion();
            next();
        },
        methods: {
            save() {
                let url = '/api/questions/add';
                if (this.id) {
                    url = '/api/questions/' + this.id;
                }
                axios.post(url, this.question)
                    .then(res => {
                        this.$router.push('/');
                    })
                    .catch(error => {
                        let messages = Object.values(error.response.data.errors);
                        this.errors = [].concat.apply([], messages);
                    });
            }
        }
    }
</script>