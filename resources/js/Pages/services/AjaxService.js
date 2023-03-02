import "axios"
import axios from "axios";

export default {
    async getTableData() {
        return (await axios.get('/api/grouped_activities')
            .catch(function (error) {
                console.log(error);
            })).data;
    }
}
