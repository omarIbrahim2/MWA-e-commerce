<template>

  <div class="container">
     
    <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>الصورة</th>
                      <th>الاسم</th>
                      <th style="width: 40px">اجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cat in Cats.data">
                      <td></td>
                      <td></td>
                      <td>{{ cat.name }}</td>
                      <td>
                        <div class="d-flex">
                            <button class="btn btn-danger">مسح</button>
                            <button class="btn btn-secondary">تعديل</button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

  </div>
</template>


<script>
 
 import { ref } from "vue"
 import axious from 'axios'
 export default {
  
    setup(){
        const Cats = ref([])
 
         const getCats = ()=>{
            axious.get('http://localhost:8000/api/categories').then(res =>{
                
                
                Cats.value = res.data
                console.log(Cats.value)
            })
            .catch(e => console.log(e))
         } 
        return{Cats , getCats}
    },

     mounted(){
        this.getCats()
     },


    name: 'CatsView'


 }

</script>