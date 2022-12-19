<template>
  <div>
    <!-- table -->
    <vue-good-table
        :columns="columns"
        :rows="rows"
        :rtl="direction"
        :line-numbers="true"
        compactMode
        :search-options="{
        enabled: true,
        externalQuery: searchTerm }"
        :select-options="{
        enabled: true,
        selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
        selectionInfoClass: 'custom-class',
        selectionText: 'rows selected',
        clearSelectionText: 'clear',
        disableSelectInfo: true, // disable the select info panel on top
        selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
      }"
        :pagination-options="{
        enabled: true,
        perPage:pageLength
      }"
    >
      <template
          slot="table-row"
          slot-scope="props"
      >

        <!-- Column: Name -->
        <span
            v-if="props.column.field === 'name'"
            class="text-nowrap"
        >
          <b-avatar
              :src="props.row.avatar"
              class="mx-1"
          />
          <span class="text-nowrap">{{ props.row.name }}</span>
        </span>

        <!-- Column: Price -->
        <span v-else-if="props.column.field === 'price'">
            {{ new Intl.NumberFormat("ru",  {style: "currency", currency: "RUB", maximumFractionDigits: 0}).format(props.row.price) }}
        </span>

        <!-- Column: Status -->
        <span v-else-if="props.column.field === 'status'">
          <b-badge
              :variant="statusVariant(props.row.status)">
            {{ props.row.status }}
          </b-badge>
        </span>

        <!-- Column: Action -->
        <span v-else-if="props.column.field === 'action'">
          <span>
            <b-dropdown
                variant="link"
                toggle-class="text-decoration-none"
                no-caret
            >
              <template v-slot:button-content>
                <feather-icon
                    icon="MoreVerticalIcon"
                    size="16"
                    class="text-body align-middle mr-25"
                />
              </template>
              <b-dropdown-item>
                <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                />
                <span><!--<b-link target="_blank" :href="props.row.url">Просмотр</b-link>--></span>
              </b-dropdown-item>
              <b-dropdown-item>
                <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                />
                <span>Редактировать</span>
              </b-dropdown-item>
              <b-dropdown-item>
                <feather-icon
                    icon="TrashIcon"
                    class="mr-50"
                />
                <span>Удалить</span>
              </b-dropdown-item>
            </b-dropdown>
          </span>
        </span>

        <!-- Column: Common -->
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>
      </template>

      <!-- pagination -->
      <template
          slot="pagination-bottom"
          slot-scope="props"
      >
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-center mb-0 mt-1">
            <span class="text-nowrap ">
              Страница 1 по
            </span>
            <b-form-select
                v-model="pageLength"
                :options="['10','50','100']"
                class="mx-1"
                @input="(value)=>props.perPageChanged({currentPerPage:value})"
            />
            <span class="text-nowrap"> из {{ props.total }} объявлений </span>
          </div>
          <div>
            <b-pagination
                :value="1"
                :total-rows="props.total"
                :per-page="pageLength"
                first-number
                last-number
                align="right"
                prev-class="prev-item"
                next-class="next-item"
                class="mt-1 mb-0"
                @input="(value)=>props.pageChanged({currentPage:value})"
            >
              <template #prev-text>
                <feather-icon
                    icon="ChevronLeftIcon"
                    size="18"
                />
              </template>
              <template #next-text>
                <feather-icon
                    icon="ChevronRightIcon"
                    size="18"
                />
              </template>
            </b-pagination>
          </div>
        </div>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import {
  BAvatar, BBadge, BPagination, BFormGroup, BFormInput, BFormSelect, BDropdown, BDropdownItem,
} from 'bootstrap-vue'
import {VueGoodTable} from 'vue-good-table'
import store from '@/store/index'
import axios from "axios";
import useJwt from "@/auth/jwt/useJwt";


export default {
  components: {
    VueGoodTable,
    BAvatar,
    BBadge,
    BPagination,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BDropdown,
    BDropdownItem,
  },
  data() {
    return {
      pageLength: 50,
      dir: false,
      columns: [
        {
          label: 'id',
          field: 'avito_id',
        },
        {
          label: 'Заголовок',
          field: 'title',
          filterOptions: {
            enabled: true,
            placeholder: 'Фильтр',
            trigger: 'enter',
          }
        },
        {
          label: 'Цена',
          field: 'price',
        },

        {
          label: 'Статус',
          field: 'status',
          filterOptions: {
            customFilter: true,
            enabled: true, // enable filter for this column
            placeholder: 'Фильтр', // placeholder for filter input
            filterDropdownItems: this.changeWorkingFilter,
            trigger: 'click', //only trigger on enter not on keyup
          }
        },
        {
          label: 'Категория',
          field: 'category_id',
        },
        {
          label: 'Action',
          field: 'action',
        },
      ],
      rows: [],
      searchTerm: '',
      status: [{
        1: 'active',
        2: 'old',
      },
        {
          1: 'light-success',
          2: 'light-danger',
        }],
    }
  },
  methods: {
    changeWorkingFilter(){
      let status = this.rows.map(val => val.status).filter((item, index, arr) => {
        return arr.indexOf(item) === index;
      });

      let foundIndex = this.columns.findIndex((c) => {
        return c.field === "status"
      });

      if (foundIndex !== -1 ){
        this.$set(this.columns[foundIndex].filterOptions, 'filterDropdownItems', status);
      }
    },
  },
  computed: {
    statusVariant() {
      const statusColor = {
        /* eslint-disable key-spacing */
        active: 'light-success',
        old: 'light-danger',
        /* eslint-enable key-spacing */
      }

      return status => statusColor[status]
    },
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
  },
  created() {
    axios.get('/api/ob/?id=11',
        {
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + useJwt.getToken()
          },
        })
        .then(response => {
          if (response.data.success) {
            this.rows = response.data.ads;
            this.changeWorkingFilter();
          }
        });
  },
}
</script>
<style lang="scss">
@import '~@resources/scss/vue/libs/vue-good-table.scss';
</style>
