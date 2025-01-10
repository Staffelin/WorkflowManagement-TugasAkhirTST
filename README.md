# **Panduan menjalankan service secara lokal menggunakan Docker**

## **Requirements**
Pastikan tools ini ada di sistem:
- Docker
- Docker Compose

### 1. **Clone repo ini**
```bash
git clone <repository-url>
cd <repository-name>
```

---

### **2. Configure Environment Variables**
Update the `.env` file with your database and application configurations. Example `.env` file:
```plaintext
CI_ENVIRONMENT = development

# Database Configuration
database.default.hostname = db
database.default.database = finalproyektst
database.default.username = postgres
database.default.password = raihan
database.default.DBDriver = Postgre
database.default.port = 5432
```

---

### **3. Build and Start the Docker Containers**

Run the following commands to build and start the Docker containers:
```bash
docker-compose up --build -d
```

This command:
- Builds the application container.
- Starts the containers for the app and PostgreSQL database.

---

### **4. Run Database Migrations**

To ensure the database schema is up-to-date, run the following commands:

1. Access the app container:
   ```bash
   docker exec -it codeigniter_app sh
   ```

2. Run migrations:
   ```bash
   php spark migrate
   ```

3. Exit the container:
   ```bash
   exit
   ```

---

### **5. Access the Application**

After the containers are up and running:
- Open your browser and navigate to: [http://localhost:8080](http://localhost:8080)

---

## **Project Structure**

```plaintext
.
├── app/                    # CodeIgniter application folder
├── public/                 # Publicly accessible files
├── writable/               # Writable files (logs, cache, etc.)
├── .env                    # Environment configuration
├── Dockerfile              # Docker image configuration
├── docker-compose.yaml     # Docker Compose configuration
└── README.md               # Project documentation
```

---

## **Stopping the Containers**

To stop the containers, run:
```bash
docker-compose down
```

This will stop and remove the containers.

---

## **Additional Commands**

### **Rebuilding the Containers**
If you make changes to the Dockerfile or `docker-compose.yaml`, rebuild the containers:
```bash
docker-compose up --build -d
```

### **Viewing Logs**
To view the logs of the app container:
```bash
docker-compose logs app
```

To view the logs of the database container:
```bash
docker-compose logs db
```

---

## **Troubleshooting**

1. **Database Connection Issues**:
   - Ensure the database service name (`db`) in the `.env` file matches the `docker-compose.yaml`.
   - Verify the database is running:
     ```bash
     docker-compose ps
     ```

2. **Clearing Cache**:
   If the application behaves unexpectedly after changes:
   ```bash
   docker exec -it codeigniter_app sh
   php spark cache:clear
   ```

---
