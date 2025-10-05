<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import ToastContainer from '@/components/ToastContainer.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import {
    Plus,
    Edit,
    Trash2,
    Eye,
    ExternalLink,
    Github,
    Calendar,
    Users,
    TrendingUp,
    Award,
    Code2,
    Palette,
    Database,
    Smartphone,
    Globe,
    Building2,
    Zap,
    Shield,
    Settings,
    Container,
    Code,
    FileCode,
    Brain
} from 'lucide-vue-next';

interface Project {
    id: number;
    project_name: string;
    project_price: number;
    project_discount: number;
    project_image: string;
    project_description: string;
    technologies: string[];
    category: string;
    year: number;
    github?: string;
    live?: string;
    featured: boolean;
    stats?: Record<string, string>;
    created_at: string;
    updated_at: string;
}

interface Props {
    projects: Project[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

// Project Management State
const showAddDialog = ref(false);
const showEditDialog = ref(false);
const showDeleteDialog = ref(false);
const selectedProject = ref<Project | null>(null);
const toastContainer = ref<InstanceType<typeof ToastContainer> | null>(null);
const editingProject = ref<Partial<Project>>({
    project_name: '',
    project_price: 0,
    project_discount: 0,
    project_description: '',
    category: '',
    technologies: [],
    year: new Date().getFullYear(),
    featured: false,
    github: '',
    live: '',
    project_image: '/images/projects/default.jpg'
});

// Categories
const categories = [
    'Enterprise',
    'FinTech',
    'Healthcare',
    'IoT',
    'E-commerce',
    'Mobile',
    'Web App',
    'API'
];

// Technology Options
const technologyOptions = [
    'React', 'Vue.js', 'Angular', 'Node.js', 'Python', 'Go', 'Java', 'PHP',
    'Laravel', 'Express', 'Django', 'Spring Boot', 'MySQL', 'PostgreSQL', 'MongoDB', 'Redis',
    'Kubernetes', 'Docker', 'AWS', 'Azure', 'GCP', 'Firebase', 'TypeScript', 'JavaScript',
    'Tailwind CSS', 'Bootstrap', 'Material-UI', 'GraphQL', 'REST API', 'WebSocket',
    'Apache Kafka', 'RabbitMQ', 'Elasticsearch', 'InfluxDB', 'TensorFlow', 'PyTorch'
];

// Computed Statistics
const stats = computed(() => [
    { title: 'Total Projects', value: props.projects.length, icon: Code2, color: 'text-blue-600' },
    { title: 'Featured Projects', value: props.projects.filter(p => p.featured).length, icon: Award, color: 'text-purple-600' },
    { title: 'Categories', value: new Set(props.projects.map(p => p.category)).size, icon: Building2, color: 'text-green-600' },
    { title: 'Technologies', value: new Set(props.projects.flatMap(p => p.technologies || [])).size, icon: Palette, color: 'text-orange-600' }
]);

// Methods
const openAddDialog = () => {
    editingProject.value = {
        project_name: '',
        project_price: 0,
        project_discount: 0,
        project_description: '',
        category: '',
        technologies: [],
        year: new Date().getFullYear(),
        featured: false,
        github: '',
        live: '',
        project_image: '/images/projects/default.jpg'
    };
    showAddDialog.value = true;

    // Test authentication
    fetch('/test-auth', {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Auth test response:', data);
    })
    .catch(error => {
        console.error('Auth test error:', error);
    });

    // Test API endpoint
    fetch('/test-api', {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('API test response:', data);
    })
    .catch(error => {
        console.error('API test error:', error);
    });

    // Test project creation endpoint
    const testData = {
        project_name: 'Test Project',
        project_description: 'Test Description',
        category: 'Test Category',
        year: 2025
    };

    fetch('/test-project-create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
        },
        body: JSON.stringify(testData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Test project creation response:', data);
    })
    .catch(error => {
        console.error('Test project creation error:', error);
    });

    // Show info message
    toastContainer.value?.addToast('📝 Add New Project form opened', 'info', 3000);
};

const openEditDialog = (project: Project) => {
    editingProject.value = { ...project };
    showEditDialog.value = true;

    // Show info message
    toastContainer.value?.addToast(`✏️ Editing project: ${project.project_name}`, 'info', 3000);
};

const openDeleteDialog = (project: Project) => {
    selectedProject.value = project;
    showDeleteDialog.value = true;

    // Show warning message
    toastContainer.value?.addToast(`⚠️ Confirm deletion of: ${project.project_name}`, 'warning', 4000);
};

const addProject = () => {
    // Basic validation
    if (!editingProject.value.project_name || !editingProject.value.category || !editingProject.value.project_description) {
        toastContainer.value?.addToast('❌ Please fill in all required fields (*)', 'error');
        return;
    }

    console.log('Sending project data:', editingProject.value);

    // Ensure all required fields are present
    const projectData = {
        ...editingProject.value,
        project_name: String(editingProject.value.project_name || '').trim(),
        project_description: String(editingProject.value.project_description || '').trim(),
        category: String(editingProject.value.category || '').trim(),
        project_price: parseFloat(String(editingProject.value.project_price || 0)) || 0,
        project_discount: parseFloat(String(editingProject.value.project_discount || 0)) || 0,
        year: parseInt(String(editingProject.value.year || new Date().getFullYear())) || new Date().getFullYear(),
        technologies: editingProject.value.technologies || [],
        featured: Boolean(editingProject.value.featured),
        github: String(editingProject.value.github || '').trim(),
        live: String(editingProject.value.live || '').trim(),
        project_image: String(editingProject.value.project_image || '/images/projects/default.jpg').trim()
    };

    console.log('Processed project data:', projectData);

    // Final validation
    if (!projectData.project_name || !projectData.category || !projectData.project_description) {
        toastContainer.value?.addToast('❌ Please fill in all required fields (*)', 'error');
        return;
    }

    // Use fetch instead of Inertia router for API calls
    console.log('Sending request to:', '/api/projects');
    console.log('Request headers:', {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'Accept': 'application/json'
    });

    fetch('/api/projects', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
        },
        body: JSON.stringify(projectData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return response.json();
    })
    .then(data => {
        console.log('Success response:', data);
        if (data.success) {
            showAddDialog.value = false;
            toastContainer.value?.addToast('✅ Project has been added successfully!', 'success');
            router.reload();
        } else {
            console.error('Server returned error:', data);
            let errorMessage = '❌ Error adding project: ' + (data.message || 'Unknown error');

            if (data.errors) {
                const errorKeys = Object.keys(data.errors);
                if (errorKeys.length > 0) {
                    errorMessage += ` - ${errorKeys[0]}: ${data.errors[errorKeys[0]][0]}`;
                }
            }

            toastContainer.value?.addToast(errorMessage, 'error');
        }
    })
    .catch(error => {
        console.error('Network error:', error);
        toastContainer.value?.addToast('❌ Network error. Please check your connection and try again.', 'error');
    });
};

const updateProject = () => {
    if (!editingProject.value.id) return;

    // Process data similar to addProject
    const projectData = {
        ...editingProject.value,
        project_name: String(editingProject.value.project_name || '').trim(),
        project_description: String(editingProject.value.project_description || '').trim(),
        category: String(editingProject.value.category || '').trim(),
        project_price: parseFloat(String(editingProject.value.project_price || 0)) || 0,
        project_discount: parseFloat(String(editingProject.value.project_discount || 0)) || 0,
        year: parseInt(String(editingProject.value.year || new Date().getFullYear())) || new Date().getFullYear(),
        technologies: editingProject.value.technologies || [],
        featured: Boolean(editingProject.value.featured),
        github: String(editingProject.value.github || '').trim(),
        live: String(editingProject.value.live || '').trim(),
        project_image: String(editingProject.value.project_image || '/images/projects/default.jpg').trim()
    };

    // Basic validation
    if (!projectData.project_name || !projectData.category || !projectData.project_description) {
        toastContainer.value?.addToast('❌ Please fill in all required fields (*)', 'error');
        return;
    }

    console.log('Updating project data:', projectData);

    // Use fetch instead of Inertia router for API calls
    fetch(`/api/projects/${editingProject.value.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
        },
        body: JSON.stringify(projectData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showEditDialog.value = false;
            toastContainer.value?.addToast('✅ Project has been updated successfully!', 'success');
            router.reload();
        } else {
            toastContainer.value?.addToast('❌ Error updating project: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error updating project:', error);
        toastContainer.value?.addToast('❌ Error updating project. Please try again.', 'error');
    });
};

const deleteProject = () => {
    if (!selectedProject.value) return;

    const projectName = selectedProject.value.project_name;

    // Use fetch instead of Inertia router for API calls
    fetch(`/api/projects/${selectedProject.value.id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showDeleteDialog.value = false;
            selectedProject.value = null;
            toastContainer.value?.addToast(`✅ Project "${projectName}" has been deleted successfully!`, 'success');
            router.reload();
        } else {
            toastContainer.value?.addToast('❌ Error deleting project: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error deleting project:', error);
        toastContainer.value?.addToast('❌ Error deleting project. Please try again.', 'error');
    });
};

const addTechnology = (tech: string) => {
    if (!editingProject.value.technologies) {
        editingProject.value.technologies = [];
    }
    if (!editingProject.value.technologies.includes(tech)) {
        editingProject.value.technologies.push(tech);
    }
};

const removeTechnology = (tech: string) => {
    if (editingProject.value.technologies) {
        editingProject.value.technologies = editingProject.value.technologies.filter(t => t !== tech);
    }
};
</script>

<template>
    <Head title="Dashboard - Project Management" />

    <AppLayout :breadcrumbs="breadcrumbs" @openAddProject="openAddDialog">
        <!-- Toast Container -->
        <ToastContainer ref="toastContainer" />
        <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 p-6">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Project Management</h1>
                        <p class="text-gray-600">Manage your portfolio projects</p>
                    </div>
                    <Button @click="openAddDialog" class="bg-blue-600 hover:bg-blue-700 text-white shadow-lg">
                        <Plus class="w-4 h-4 mr-2" />
                        Add New Project
                    </Button>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card v-for="stat in stats" :key="stat.title" class="bg-white border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <CardContent class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ stat.title }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ stat.value }}</p>
                                </div>
                                <component :is="stat.icon" class="w-8 h-8" :class="stat.color" />
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Projects Table -->
                <Card class="bg-white border-gray-200 shadow-sm">
                    <CardHeader class="bg-gray-50 border-b border-gray-200">
                        <CardTitle class="text-gray-900">Projects</CardTitle>
                        <CardDescription class="text-gray-600">Manage your portfolio projects</CardDescription>
                    </CardHeader>
                    <CardContent class="p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="text-left p-4 font-medium text-gray-900">Project</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Category</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Price</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Discount</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Year</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Status</th>
                                        <th class="text-left p-4 font-medium text-gray-900">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="project in projects" :key="project.id" class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <img :src="project.project_image" :alt="project.project_name" class="w-12 h-12 rounded-lg object-cover border border-gray-200" />
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ project.project_name }}</p>
                                                    <p class="text-sm text-gray-600">{{ project.project_description.substring(0, 50) }}...</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <Badge variant="outline" class="border-blue-200 text-blue-700 bg-blue-50">{{ project.category }}</Badge>
                                        </td>
                                        <td class="p-4 text-gray-600">
                                            <span v-if="project.project_price && typeof project.project_price === 'number'" class="font-medium text-green-600">${{ project.project_price.toFixed(2) }}</span>
                                            <span v-else class="text-gray-400">-</span>
                                        </td>
                                        <td class="p-4 text-gray-600">
                                            <span v-if="project.project_discount" class="font-medium text-orange-600">{{ project.project_discount }}%</span>
                                            <span v-else class="text-gray-400">-</span>
                                        </td>
                                        <td class="p-4 text-gray-600">{{ project.year }}</td>
                                        <td class="p-4">
                                            <Badge v-if="project.featured" class="bg-yellow-500 text-white">
                                                Featured
                                            </Badge>
                                            <Badge v-else variant="outline" class="border-gray-300 text-gray-600">
                                                Regular
                                            </Badge>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex space-x-2">
                                                <Button size="sm" variant="outline" @click="openEditDialog(project)" class="border-gray-300 text-gray-700 hover:bg-gray-50">
                                                    <Edit class="w-4 h-4" />
                                                </Button>
                                                <Button size="sm" variant="outline" asChild v-if="project.live" class="border-green-300 text-green-700 hover:bg-green-50">
                                                    <a :href="project.live" target="_blank">
                                                        <ExternalLink class="w-4 h-4" />
                                                    </a>
                                                </Button>
                                                <Button size="sm" variant="outline" asChild v-if="project.github" class="border-gray-300 text-gray-700 hover:bg-gray-50">
                                                    <a :href="project.github" target="_blank">
                                                        <Github class="w-4 h-4" />
                                                    </a>
                                                </Button>
                                                <Button size="sm" variant="destructive" @click="openDeleteDialog(project)" class="bg-red-500 hover:bg-red-600 text-white">
                                                    <Trash2 class="w-4 h-4" />
                                                </Button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>

        <!-- Add Project Dialog -->
        <Dialog v-model:open="showAddDialog">
            <DialogContent class="max-w-2xl bg-white border-gray-200">
                <DialogHeader>
                    <DialogTitle class="text-gray-900">Add New Project</DialogTitle>
                    <DialogDescription class="text-gray-600">Create a new project for your portfolio</DialogDescription>
                </DialogHeader>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="title" class="text-gray-700">Project Name *</Label>
                            <Input id="title" v-model="editingProject.project_name" placeholder="Enter project name" class="border-gray-300 focus:border-blue-500" required />
                        </div>
                        <div>
                            <Label for="category" class="text-gray-700">Category *</Label>
                            <select v-model="editingProject.category" class="w-full p-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Select category</option>
                                <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="price" class="text-gray-700">Project Price ($)</Label>
                            <Input id="price" v-model="editingProject.project_price" type="number" step="0.01" placeholder="0.00" class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="discount" class="text-gray-700">Discount (%)</Label>
                            <Input id="discount" v-model="editingProject.project_discount" type="number" step="0.01" placeholder="0.00" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div>
                        <Label for="description" class="text-gray-700">Description *</Label>
                        <Textarea id="description" v-model="editingProject.project_description" placeholder="Enter project description" rows="3" class="border-gray-300 focus:border-blue-500" required />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="year" class="text-gray-700">Year</Label>
                            <Input id="year" v-model="editingProject.year" type="number" placeholder="2024" class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="image" class="text-gray-700">Image URL</Label>
                            <Input id="image" v-model="editingProject.project_image" placeholder="/images/projects/project.jpg" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="github" class="text-gray-700">GitHub URL (Optional)</Label>
                            <Input id="github" v-model="editingProject.github" placeholder="https://github.com/..." class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="live" class="text-gray-700">Live URL (Optional)</Label>
                            <Input id="live" v-model="editingProject.live" placeholder="https://project.com" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div>
                        <Label class="text-gray-700">Technologies</Label>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <Badge
                                v-for="tech in editingProject.technologies"
                                :key="tech"
                                variant="outline"
                                class="cursor-pointer hover:bg-red-100 border-red-200 text-red-700"
                                @click="removeTechnology(tech)"
                            >
                                {{ tech }} ×
                            </Badge>
                        </div>
                        <div class="mt-2">
                            <select @change="(event) => addTechnology((event.target as HTMLSelectElement).value)" class="w-full p-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Add technology</option>
                                <option v-for="tech in technologyOptions" :key="tech" :value="tech">{{ tech }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input id="featured" v-model="editingProject.featured" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <Label for="featured" class="text-gray-700">Featured Project</Label>
                    </div>
                </div>
                <DialogFooter>
                    <Button variant="outline" @click="showAddDialog = false" class="border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</Button>
                    <Button @click="addProject" class="bg-blue-600 hover:bg-blue-700 text-white">Add Project</Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>

        <!-- Edit Project Dialog -->
        <Dialog v-model:open="showEditDialog">
            <DialogContent class="max-w-2xl bg-white border-gray-200">
                <DialogHeader>
                    <DialogTitle class="text-gray-900">Edit Project</DialogTitle>
                    <DialogDescription class="text-gray-600">Update project information</DialogDescription>
                </DialogHeader>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="edit-title" class="text-gray-700">Project Name *</Label>
                            <Input id="edit-title" v-model="editingProject.project_name" placeholder="Enter project name" class="border-gray-300 focus:border-blue-500" required />
                        </div>
                        <div>
                            <Label for="edit-category" class="text-gray-700">Category *</Label>
                            <select v-model="editingProject.category" class="w-full p-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Select category</option>
                                <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="edit-price" class="text-gray-700">Project Price ($)</Label>
                            <Input id="edit-price" v-model="editingProject.project_price" type="number" step="0.01" placeholder="0.00" class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="edit-discount" class="text-gray-700">Discount (%)</Label>
                            <Input id="edit-discount" v-model="editingProject.project_discount" type="number" step="0.01" placeholder="0.00" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div>
                        <Label for="edit-description" class="text-gray-700">Description *</Label>
                        <Textarea id="edit-description" v-model="editingProject.project_description" placeholder="Enter project description" rows="3" class="border-gray-300 focus:border-blue-500" required />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="edit-year" class="text-gray-700">Year</Label>
                            <Input id="edit-year" v-model="editingProject.year" type="number" placeholder="2024" class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="edit-image" class="text-gray-700">Image URL</Label>
                            <Input id="edit-image" v-model="editingProject.project_image" placeholder="/images/projects/project.jpg" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="edit-github" class="text-gray-700">GitHub URL (Optional)</Label>
                            <Input id="edit-github" v-model="editingProject.github" placeholder="https://github.com/..." class="border-gray-300 focus:border-blue-500" />
                        </div>
                        <div>
                            <Label for="edit-live" class="text-gray-700">Live URL (Optional)</Label>
                            <Input id="edit-live" v-model="editingProject.live" placeholder="https://project.com" class="border-gray-300 focus:border-blue-500" />
                        </div>
                    </div>
                    <div>
                        <Label class="text-gray-700">Technologies</Label>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <Badge
                                v-for="tech in editingProject.technologies"
                                :key="tech"
                                variant="outline"
                                class="cursor-pointer hover:bg-red-100 border-red-200 text-red-700"
                                @click="removeTechnology(tech)"
                            >
                                {{ tech }} ×
                            </Badge>
                        </div>
                        <div class="mt-2">
                            <select @change="(event) => addTechnology((event.target as HTMLSelectElement).value)" class="w-full p-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Add technology</option>
                                <option v-for="tech in technologyOptions" :key="tech" :value="tech">{{ tech }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input id="edit-featured" v-model="editingProject.featured" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <Label for="edit-featured" class="text-gray-700">Featured Project</Label>
                    </div>
                </div>
                <DialogFooter>
                    <Button variant="outline" @click="showEditDialog = false" class="border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</Button>
                    <Button @click="updateProject" class="bg-blue-600 hover:bg-blue-700 text-white">Update Project</Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>

        <!-- Delete Project Dialog -->
        <Dialog v-model:open="showDeleteDialog">
            <DialogContent class="bg-white border-gray-200">
                <DialogHeader>
                    <DialogTitle class="text-gray-900">Delete Project</DialogTitle>
                    <DialogDescription class="text-gray-600">
                        Are you sure you want to delete <strong>"{{ selectedProject?.project_name }}"</strong>? This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="showDeleteDialog = false" class="border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</Button>
                    <Button @click="deleteProject" variant="destructive" class="bg-red-500 hover:bg-red-600 text-white">Delete Project</Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>

<style scoped>
/* Custom styles for better UX */
select {
    background-color: white;
    color: #374151;
}
</style>
