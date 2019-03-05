<template>
    <div class="container-fluid">
        <!-- Begin Product Form Section -->
        <section>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card card-shadow mb-4">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap bar-primary">
                                <div class="custom-title">Coalition Test</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="productName" v-model="product.name">
                            </div>
                            <div class="form-group">
                                <label>Quantity in Stock</label>
                                <input type="number" class="form-control" name="qty" v-model="product.qty">
                            </div>
                            <div class="form-group">
                                <label>Price Per Item</label>
                                <input type="number" class="form-control" name="perItem" v-model="product.perItem">
                            </div>
                            <div class="text-center">
                                <button @click="saveProduct()" type="button" class="btn btn-purple">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product form section -->

        <!-- Begin Datatable Section-->
        <section v-if="products.length">

            <div class="row">
                <div class="col-12">
                    <div class="card card-shadow mb-4 p-md-5">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">&nbsp;</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity in Stock</th>
                                                <th scope="col">Price Per Item</th>
                                                <th scope="col">Date/Time Submitted</th>
                                                <th scope="col">Total Value</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-muted">
                                            <tr v-for="(prod, index) in products">
                                                <td>
                                                    <a @click="editProduct(index)">
                                                        <i class="fa fa-edit p-2"></i>
                                                    </a>
                                                </td>
                                                <td>{{ prod.name }}</td>
                                                <td>{{ prod.qty }}</td>
                                                <td>${{ prod.perItem }}</td>
                                                <td>{{ prod.created_at }}</td>
                                                <td>${{ (prod.qty * prod.perItem) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="col-sm-4 offset-sm-8">
                                    <table class="table invoice-table text-muted" style="margin-top: -1.01rem">
                                        <tbody>
                                        <tr>
                                            <th class="text-dark">Total</th>
                                            <th><span class="f24 text-dark">${{ calculateTotal }}</span></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </section>
        <!-- End Datatable Section -->
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';

    export default {
        props : [],

        /**
         * The component's data.
         */
        data() {
            return {
                product : {
                    name : '',
                    qty : '',
                    perItem : '',
                },
                products: [],
            };
        },

        mounted(){

        },

        methods: {
            /**
             * Handles saving the product
             */
            saveProduct(){
                //set the timestamps...
                this.product.created_at = new moment.utc().format('MM/DD/YYYY hh:mm:ss'); //utc time :)
                this.product.updated_at = new moment.utc().format('MM/DD/YYYY hh:mm:ss'); //utc time :)

                this.products.push(this.product);
                let postData = {
                  data : {
                      products : this.products
                  }
                };
                axios.post('/product', postData).then((res) => {
                    console.log(res.data);
                    this.products = res.data.data.products; //get the ajax data back.
                    this.product = {}; //reset the object
                });

            },

            /**
             * Handles editing the product
             * @param index
             */
            editProduct(index){
                this.product = this.products[index];
                this.products.splice(index, 1);
            }

        },

        computed: {

            /**
             * Handles calculating the total
             * @returns {*}
             */
            calculateTotal(){
                var sum = this.products.reduce((acc, item) => acc + (item.perItem * item.qty ), 0);
                return sum
            }

        }
    }
</script>
