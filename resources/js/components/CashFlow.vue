<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Cash Flow Update Form</div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md">
                                    <select class="form-select" aria-label="Client"
                                            v-model="cashFlowUpdateForm.formData.client_id" @change="getClientData()">
                                        <option selected disabled>Choose Client</option>
                                        <option v-for="client in cashFlowUpdateForm.filters.clients" :value="client.id">
                                            {{
                                            client.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select class="form-select" aria-label="Fund"
                                            v-model="cashFlowUpdateForm.formData.fundType"
                                            @change="getInvestmentFundData()">
                                        <option selected disabled>Choose Fund Type</option>
                                        <option v-for="fundType in cashFlowUpdateForm.filters.fundTypes"
                                                :value="fundType">
                                            {{ fundType }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select class="form-select" aria-label="Investment"
                                            v-model="cashFlowUpdateForm.formData.investment_id"
                                            @change="getInvestmentData()">
                                        <option selected disabled>Choose Investment</option>
                                        <option v-for="investment in cashFlowUpdateForm.filters.investments"
                                                :value="investment.id">{{ investment.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <span v-if="investmentCurrentValueFormatted.length > 0">Current Value:<br> {{ investmentCurrentValueFormatted }}</span>
                                </div>
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <span v-if="investmentUpdatedValueFormatted.length > 0">Updated Value:<br> {{ investmentUpdatedValueFormatted }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <div>
                                        <label for="date">Date</label><br>
                                        <input type="date" step="1" min="2021-03-01" :class="errors.has('formData.date') ? 'form-control is-invalid' : 'form-control'" id="date"
                                               v-model="cashFlowUpdateForm.formData.date" @change="errors.clear('formData.date')">
                                        <div class="invalid-feedback" v-if="errors.has('formData.date')" v-text="errors.get('formData.date')"></div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div>
                                        <label for="returnValue">Value (%)</label><br>
                                        <input type="number" :class="errors.has('formData.date') ? 'form-control is-invalid' : 'form-control'" id="returnValue"
                                               v-model="cashFlowUpdateForm.formData.returnValue" @change="errors.clear('formData.returnValue')">
                                        <div class="invalid-feedback" v-if="errors.has('formData.returnValue')" v-text="errors.get('formData.returnValue')"></div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <br>
                                        <a class="btn btn-primary"
                                           @click="calculateInvestmentUpdatedValue()">Calculate</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <br>
                                    <a class="btn btn-primary" @click="cancelInvestmentUpdatedValue()">Cancel</a>
                                </div>
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <br>
                                    <a class="btn btn-success" @click="addCashFlow()">Submit</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../errors';

    export default {
        data() {
            return {
                cashFlowUpdateForm: {
                    filters: {
                        client: {},
                        clients: [],
                        fundTypes: [],
                        investment: {},
                        investments: [],
                        investmentCurrentValue: '',
                        investmentUpdatedValue: ''
                    },
                    formData: {
                        client_id: '',
                        date: '',
                        fundType: '',
                        investment_id: '',
                        returnValue: ''
                    }
                },
                errors: new Errors()
            }
        },
        computed: {
            investmentCurrentValueFormatted() {
                return this.formatCurrency(this.cashFlowUpdateForm.filters.investmentCurrentValue);
            },
            investmentUpdatedValueFormatted() {
                return this.formatCurrency(this.cashFlowUpdateForm.filters.investmentUpdatedValue);
            }
        },
        methods: {
            getClientData() {
                this.$http.post('/cash-flow/clients/' + this.cashFlowUpdateForm.formData.client_id, {}).then(response => {
                    this.cashFlowUpdateForm.filters.client = response.data.client;

                    // Set contextual select options for fundTypes
                    this.cashFlowUpdateForm.filters.fundTypes = response.data.fundTypes;

                    // Unset chosen contextual select options
                    this.cashFlowUpdateForm.formData.fundType = '';
                    this.cashFlowUpdateForm.formData.investment_id = '';

                    // Remove contextual select options for Investments (Dynamically added once fund type selected)
                    this.cashFlowUpdateForm.filters.investments = [];

                    // Unset until investment chosen
                    this.cashFlowUpdateForm.filters.investmentCurrentValue = '';
                }).catch(error => {
                    // TODO
                });
            },
            getInvestmentFundData() {
                this.$http.post('/cash-flow/clients/' + this.cashFlowUpdateForm.formData.client_id + '/investments', {
                    fundType: this.cashFlowUpdateForm.formData.fundType
                }).then(response => {
                    // Set contextual select options for Investments
                    this.cashFlowUpdateForm.filters.investments = response.data.investments;

                    // Unset chosen contextual select options
                    this.cashFlowUpdateForm.formData.investment_id = '';

                    // Unset until investment chosen
                    this.cashFlowUpdateForm.filters.investmentCurrentValue = '';
                }).catch(error => {
                    // TODO
                });
            },
            getInvestmentData() {
                if (this.cashFlowUpdateForm.formData.investment_id) {
                    this.$http.post('/cash-flow/clients/' + this.cashFlowUpdateForm.formData.client_id + '/investments/' + this.cashFlowUpdateForm.formData.investment_id, {
                        fundType: this.cashFlowUpdateForm.formData.fundType,
                        investment_id: this.cashFlowUpdateForm.formData.investment_id
                    }).then(response => {
                        this.cashFlowUpdateForm.filters.investment = response.data.investment;

                        // Auto set and format current investment value
                        this.cashFlowUpdateForm.filters.investmentCurrentValue = this.calculateInvestmentCurrentValue();
                        this.cashFlowUpdateForm.filters.investmentCurrentValueFormatted = this.formatCurrency(this.cashFlowUpdateForm.filters.investmentCurrentValue);
                    }).catch(error => {
                        // TODO
                    });
                }
            },
            calculateInvestmentCurrentValue() {
                let investment = this.cashFlowUpdateForm.filters.investment;
                let currentValue = investment.amount;

                investment.cash_flows.forEach(cashFlow => {
                    currentValue = currentValue * (1 + (cashFlow.return / 100));
                });

                return currentValue;
            },
            calculateInvestmentUpdatedValue() {
                // Set investmentUpdatedValue
                this.cashFlowUpdateForm.filters.investmentUpdatedValue = this.cashFlowUpdateForm.filters.investmentCurrentValue * (1 + (this.cashFlowUpdateForm.formData.returnValue / 100));
            },
            cancelInvestmentUpdatedValue() {
                // Clear Form Values
                this.cashFlowUpdateForm.filters.investmentUpdatedValue = 0;
                this.cashFlowUpdateForm.formData.date = '';
                this.cashFlowUpdateForm.formData.returnValue = '';
            },
            formatCurrency(value) {
                const formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                });

                return formatter.format(value);
            },
            addCashFlow() {
                this.$http.post('/cash-flow', {
                    formData: this.cashFlowUpdateForm.formData,
                }).then(response => {

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors.record(error.response.data);
                    }
                });
                this.getInvestmentData();
                this.cancelInvestmentUpdatedValue();
            }
        },
        beforeMount() {
            // Fetch Client Data
            this.$http.post('/cash-flow/clients', {}).then(response => {
                this.cashFlowUpdateForm.filters.clients = response.data;
            }).catch(error => {
                // TODO
            });
        }
    }
</script>
