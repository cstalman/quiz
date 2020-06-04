<template>
    <div class="container">
        <h2 class="my-4">Beheer toetsen</h2>
        <form class="question-form" @submit.prevent="saveQuizzes"> 
            <a @click="addQuiz" class="btn btn-primary d-inline-block mb-2 text-white add"><i class="fa fa-plus-circle"></i> Toets toevoegen</a>
            <div class="form-row" v-for="(quiz, index) in quizzes" :key="quiz.id">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" v-model="quiz.title" :ref="quiz.title">
                </div>
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" v-model="quiz.description">
                </div>
                <div class="form-group col-md-2">
                    <a @click="removeQuiz(index)" class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-times-circle"></i> Verwijder toets</a>
                </div>
                <div class="form-group col-md-2">
                    <a :href="'/quiz-preview/' + quiz.id" class="btn btn-primary d-inline-block mb-2 text-white remove"><i class="fa fa-search"></i> Preview toets</a>
                </div>

            </div>
            <button type="submit" class="btn btn-primary d-inline-block mb-2 text-white"><i class="fa fa-check-circle"></i> Opslaan</button>
            <div>{{ feedback }}</div>
        </form>
    </div>
</template>

<script>

    export default {
        props: ['initialQuizzes'],
        data() {
            return {
                quizzes: _.cloneDeep(this.initialQuizzes), 
                feedback: ''
            }
        },
        created() {
            this.fetchQuizzes();
        },
        methods: {
            fetchQuizzes() {
                axios.get('/api/quizzes')
                    .then(res => this.quizzes = res.data);
            },
            removeQuiz(index) {
               if (confirm('Weet je het zeker?')) {
                   let id = this.quizzes[index].id
                   if (id > 0) {
                       axios.delete('/api/quizzes/' + id);
                   }
                   this.quizzes.splice(index, 1);
               }
            },
            addQuiz() {
                this.quizzes.push({
                    id: 0,
                    title: '',
                    description: '',
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                });
            },
            saveQuizzes() {
                axios.post('/api/quizzes/insup', {
                    quizzes: this.quizzes
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'De wijzigingen zijn opgeslagen';
                        this.quizzes = res.data.quizzes;
                    }     
                });
            },
        }
    }
</script>

<style scoped>
    input {
        margin-right: 10px;
    }
    
    hr {
        margin-bottom: 10px;
        max-width: 1140px;
    }

    @media (max-width: 632px) {
        input{
            margin-bottom: 10px;
        }
    }

</style>