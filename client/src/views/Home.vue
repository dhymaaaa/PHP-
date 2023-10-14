<template>
  <v-card
    class="mx - 3"
    title = "Students"
  > 
  <v-btn color="primary" @click = "$refs.studentModal.open()"> New Student </v-btn>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">
          First name
        </th>
        <th class="text-left">
          Last name
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in items"
        :key="item.id"
      >
        <td>{{ item.first_name }}</td>
        <td>{{ item.last_name }}</td>
        <td>
          <v-icon size ="sm" color="blue"
          @click="$refs.studentModal.edit(item.id)"
          >
          mdi-pencil
          </v-icon>
          <v-icon size ="sm" color="red"
          @click="$refs.studentModal.delete(item.id)"
          >
          mdi-delete
          </v-icon>
        </td>
      </tr>
    </tbody>
  </v-table>
  </v-card>
  <StudentModal @reload="getItems()" ref="studentModal"></StudentModal>
</template>

<script>
  import axios from "axios"
  import StudentModal from "@/components/StudentModal.vue"
  // import HelloWorld from '@/components/HelloWorld.vue'
  export default {
    components: {StudentModal},
    data: () => ({
      items: [],
    }),
    methods: {
      getItems(){
        axios({
          method: 'get',
          url: 'http://localhost:8000/api/students'
        }).then((resp) => {
          this.items = resp.data
        })
      },
    },
    mounted(){
      this.getItems()
    }
  }
</script>
