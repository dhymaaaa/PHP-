<template>
    <v-dialog width="500" v-model="show">
    <v-card title="Student">
        <v-text-field label="First Name"
        v-model="student.first_name">
        </v-text-field>
        <v-text-field label="Last Name"
        v-model="student.last_name">
        </v-text-field>
      <v-card-actions>
        <v-btn color="red" @click="close"> Close </v-btn>
        <v-btn v-if = "!student.id" color="green" @click="save"> Save </v-btn>
        <v-btn v-if = "student.id" color="blue" @click="update"> Update </v-btn>
        <v-spacer>    
        </v-spacer>
        <v-btn @click="isActive.value = false">
        </v-btn>
      </v-card-actions>
    </v-card>
</v-dialog>
</template>

<script>
import axios from 'axios';

    export default {
        data: () => ({
            show: false,
            student: {
                first_name: '',
                last_name: '',
            }
        }),
        methods: {
            delete(id){
                axios({
                method: 'delete',
                url: `http://localhost:8000/api/students/${id}`
                }).then((resp) => {
                    //this.items = resp.data
                    this.close()
                })
            },
            update(){
                axios({
                method: 'put',
                url: `http://localhost:8000/api/students/${this.student.id}`,
                data: this.student
                }).then((resp) => {
                    //this.items = resp.data
                    this.close()
                })
            },
            save(){
                axios({
                    method: 'post',
                    url: 'http://localhost:8000/api/students',
                    data: this.student
                }).then((resp) => {
                    this.close()
                });
            },
            edit(id){
                axios({
                method: 'get',
                url: `http://localhost:8000/api/students/${id}`
                }).then((resp) => {
                    this.student = resp.data
                    this.open()
                })
                
            },
            open(){
                this.show = true
            },
            close(){
                this.student = {}
                this.$emit('reload')
                this.show = false
            }
        }
    }
</script>