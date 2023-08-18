import axios from 'axios';

export async function fetchRooms(filters) {
    try {
        const response = await axios.get('/api/rooms', { params: filters });
        return response.data;
    } catch (error) {
        console.error(error);
        return [];
    }
}


export async function fetchServices() {
    try {
        const response = await axios.get('/api/services');
        return response.data;
    } catch (error) {
        console.error(error);
        return [];
    }
}
