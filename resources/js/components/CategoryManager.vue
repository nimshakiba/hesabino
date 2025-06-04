<template>
    <div>
        <div class="flex items-center mb-6">
            <button class="btn-back" @click="goBack">
                <i class="fas fa-arrow-right"></i>
            </button>
            <h2 class="page-title">{{ pageTitle }}</h2>
        </div>
        <div class="tabs">
            <button
                v-for="type in types"
                :key="type.value"
                class="tab"
                :class="{ active: selectedType === type.value }"
                @click="selectType(type.value)"
            >
                {{ type.label }}
            </button>
        </div>
        <div class="category-section">
            <form @submit.prevent="submitCategory" class="category-form">
                <input v-model="form.name" placeholder="نام دسته" required />
                <select v-model="form.parent_id">
                    <option :value="null">بدون والد</option>
                    <option v-for="cat in categories" :value="cat.id" :key="cat.id">
                        {{ cat.name }}
                    </option>
                </select>
                <button type="submit" class="btn-primary">
                    {{ form.id ? 'ویرایش' : 'افزودن' }}
                </button>
                <button v-if="form.id" @click="resetForm" type="button" class="btn-secondary">انصراف</button>
            </form>
            <ul class="category-list">
                <CategoryTree
                    :categories="categories"
                    @edit="editCategory"
                    @delete="deleteCategory"
                />
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, watch, onMounted } from 'vue';
import axios from 'axios';

const types = [
    { value: 'person', label: 'دسته‌بندی اشخاص' },
    { value: 'product', label: 'دسته‌بندی کالا' },
    { value: 'service', label: 'دسته‌بندی خدمات' },
];

const pageTitle = ref('مدیریت دسته‌بندی‌ها');
const selectedType = ref(types[0].value);
const categories = ref([]);
const form = reactive({ id: null, name: '', parent_id: null });

function goBack() {
    window.location.href = '/dashboard';
}

function selectType(type) {
    selectedType.value = type;
    resetForm();
    fetchCategories();
}

function resetForm() {
    form.id = null;
    form.name = '';
    form.parent_id = null;
}

async function fetchCategories() {
    try {
        const response = await axios.get(`/api/categories?type=${selectedType.value}`);
        categories.value = response.data;
    } catch (e) {
        alert('دریافت دسته‌بندی‌ها ناموفق بود.');
    }
}

async function submitCategory() {
    try {
        if (form.id) {
            await axios.put(`/api/categories/${form.id}`, { ...form, type: selectedType.value });
        } else {
            await axios.post('/api/categories', { ...form, type: selectedType.value });
        }
        resetForm();
        fetchCategories();
    } catch (e) {
        alert('ثبت اطلاعات ناموفق بود.');
    }
}

function editCategory(cat) {
    form.id = cat.id;
    form.name = cat.name;
    form.parent_id = cat.parent_id;
}

async function deleteCategory(cat) {
    if (!confirm('حذف این دسته‌بندی مطمئن هستید؟')) return;
    try {
        await axios.delete(`/api/categories/${cat.id}`);
        fetchCategories();
    } catch (e) {
        alert('حذف دسته‌بندی ناموفق بود.');
    }
}

onMounted(fetchCategories);
watch(selectedType, fetchCategories);

// Component for recursive category tree
const CategoryTree = {
    props: ['categories'],
    emits: ['edit', 'delete'],
    template: `
        <ul>
            <li v-for="cat in categories" :key="cat.id">
                <span>{{ cat.name }}</span>
                <button @click="$emit('edit', cat)" class="btn-edit"><i class="fas fa-edit"></i></button>
                <button @click="$emit('delete', cat)" class="btn-delete"><i class="fas fa-trash"></i></button>
                <CategoryTree
                    v-if="cat.childrenRecursive && cat.childrenRecursive.length"
                    :categories="cat.childrenRecursive"
                    @edit="$emit('edit', $event)"
                    @delete="$emit('delete', $event)"
                />
            </li>
        </ul>
    `
};
</script>

<style scoped>
.tabs { display: flex; gap: 1rem; margin-bottom: 1rem; }
.tab { background: #eee; border: none; padding: 8px 18px; border-radius: 6px 6px 0 0; cursor: pointer; }
.tab.active { background: #fff; color: #2d3a4b; font-weight: bold; border-bottom: 2px solid #ffd600; }
.category-section { background: #fff; padding: 24px; border-radius: 14px; box-shadow: 0 2px 8px #0001; }
.category-form { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
.category-form input, .category-form select { padding: 7px 13px; border-radius: 5px; border: 1px solid #ddd; }
.category-list { margin-top: 1rem; }
.btn-primary { background: #ffd600; border: none; padding: 7px 16px; border-radius: 6px; font-weight: bold; cursor: pointer; }
.btn-secondary { background: #ccc; border: none; padding: 7px 16px; border-radius: 6px; cursor: pointer; }
.btn-edit, .btn-delete { background: none; border: none; margin-right: 7px; cursor: pointer; color: #555; }
.btn-delete { color: #ba181b; }
.page-title { font-size: 1.3rem; font-weight: bold; margin-right: 1rem; }
.btn-back { background: #f3f3f3; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; margin-left: 12px; }
.flex { display: flex; align-items: center; }
</style>
