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

export async function fetchAvailableRooms(filters) {
    try {
        const response = await axios.get('/api/check-room-availability', { params: this.selectedDate });
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
export async function fetchBookings() {
    try {
        const response = await axios.get('/api/bookings');
        return response.data;
    } catch (error) {
        console.error(error);
        return [];
    }
}
