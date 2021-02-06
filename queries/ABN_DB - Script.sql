USE [master]
GO
/****** Object:  Database [ABN_Job_Portal]    Script Date: 06/02/2021 6:36:17 pm ******/
CREATE DATABASE [ABN_Job_Portal]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'ABN_Job_Portal', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_Job_Portal.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'ABN_Job_Portal_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_Job_Portal_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [ABN_Job_Portal] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [ABN_Job_Portal].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ARITHABORT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [ABN_Job_Portal] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [ABN_Job_Portal] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET  ENABLE_BROKER 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [ABN_Job_Portal] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET RECOVERY FULL 
GO
ALTER DATABASE [ABN_Job_Portal] SET  MULTI_USER 
GO
ALTER DATABASE [ABN_Job_Portal] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [ABN_Job_Portal] SET DB_CHAINING OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [ABN_Job_Portal] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [ABN_Job_Portal] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [ABN_Job_Portal] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'ABN_Job_Portal', N'ON'
GO
ALTER DATABASE [ABN_Job_Portal] SET QUERY_STORE = OFF
GO
USE [ABN_Job_Portal]
GO
/****** Object:  Table [dbo].[Employers]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employers](
	[employerID] [int] IDENTITY(1,1) NOT NULL,
	[companyName] [varchar](max) NOT NULL,
	[street] [varchar](max) NOT NULL,
	[brgyDistrict] [varchar](max) NOT NULL,
	[cityProvince] [varchar](max) NOT NULL,
	[contactNumber] [varchar](max) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[website] [varchar](max) NULL,
	[description] [varchar](max) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_employerID@Employers] PRIMARY KEY CLUSTERED 
(
	[employerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobPosts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobPosts](
	[jobPostID] [int] IDENTITY(1,1) NOT NULL,
	[employerID] [int] NOT NULL,
	[jobTitle] [varchar](max) NOT NULL,
	[jobType] [varchar](max) NOT NULL,
	[field] [varchar](max) NOT NULL,
	[description] [varchar](max) NOT NULL,
	[responsibilities] [varchar](max) NOT NULL,
	[skills] [varchar](max) NOT NULL,
	[experiences] [varchar](max) NOT NULL,
	[education] [varchar](max) NOT NULL,
	[minSalary] [money] NOT NULL,
	[maxSalary] [money] NOT NULL,
	[dateCreated] [datetime] NOT NULL,
	[dateModified] [datetime] NULL,
	[jobPostFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_jobPostID@JobPosts] PRIMARY KEY CLUSTERED 
(
	[jobPostID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  View [dbo].[Posts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Posts View
CREATE VIEW [dbo].[Posts] 
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict]
		, [Employers].[cityProvince]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
			AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[jobPostFlag] = 1

GO
/****** Object:  View [dbo].[JobDetails]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Job Details
CREATE VIEW [dbo].[JobDetails]
AS
SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[jobPostFlag] = 1

GO
/****** Object:  Table [dbo].[Applications]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Applications](
	[applicationID] [int] IDENTITY(1,1) NOT NULL,
	[jobPostID] [int] NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[headline] [varchar](max) NULL,
	[description] [varchar](max) NULL,
	[education] [varchar](max) NULL,
	[skills] [varchar](max) NULL,
	[experiences] [varchar](max) NULL,
	[resumeFile] [varchar](max) NULL,
	[lastUpdated] [varchar](max) NULL,
	[status] [varchar](max) NOT NULL,
	[dateApplied] [datetime] NOT NULL,
	[dateStatus] [datetime] NULL,
 CONSTRAINT [PK_applicationID@Applications] PRIMARY KEY CLUSTERED 
(
	[applicationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Bookmarks]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Bookmarks](
	[bookmarkID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[jobPostID] [int] NOT NULL,
	[dateBookmarked] [datetime] NOT NULL,
 CONSTRAINT [PK_bookmarkID@Bookmarks] PRIMARY KEY CLUSTERED 
(
	[bookmarkID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JBSK_Notifications]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JBSK_Notifications](
	[notificationID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[title] [varchar](max) NOT NULL,
	[message] [varchar](max) NOT NULL,
	[notificationType] [varchar](max) NOT NULL,
	[link] [varchar](max) NOT NULL,
	[readFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_notificationID@Notifications] PRIMARY KEY CLUSTERED 
(
	[notificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobSeekers]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobSeekers](
	[jobseekerID] [int] IDENTITY(1,1) NOT NULL,
	[firstName] [varchar](max) NOT NULL,
	[middleName] [varchar](max) NULL,
	[lastName] [varchar](max) NOT NULL,
	[birthDate] [date] NOT NULL,
	[gender] [varchar](max) NOT NULL,
	[cityProvince] [varchar](max) NOT NULL,
	[contactNumber] [varchar](max) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_jobseekerID@JobSeekers] PRIMARY KEY CLUSTERED 
(
	[jobseekerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Resumes]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Resumes](
	[resumeID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[headline] [varchar](max) NULL,
	[description] [varchar](max) NULL,
	[skills] [varchar](max) NULL,
	[experiences] [varchar](max) NULL,
	[education] [varchar](max) NULL,
	[resumeFile] [varchar](max) NULL,
	[lastUpdated] [datetime] NOT NULL,
	[resumeFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_resumeID@Resumes] PRIMARY KEY CLUSTERED 
(
	[resumeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [UK_jobseekerID@Resumes] UNIQUE NONCLUSTERED 
(
	[jobseekerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserAccounts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserAccounts](
	[userID] [int] IDENTITY(1,1) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[password] [varchar](max) NOT NULL,
	[userType] [varchar](max) NOT NULL,
	[accountFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_userID@UserAccounts] PRIMARY KEY CLUSTERED 
(
	[userID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [UQ_email@UserAccounts] UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT ('Pending') FOR [status]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT (getdate()) FOR [dateApplied]
GO
ALTER TABLE [dbo].[Bookmarks] ADD  DEFAULT (getdate()) FOR [dateBookmarked]
GO
ALTER TABLE [dbo].[JBSK_Notifications] ADD  DEFAULT ((0)) FOR [readFlag]
GO
ALTER TABLE [dbo].[JobPosts] ADD  DEFAULT (getdate()) FOR [dateCreated]
GO
ALTER TABLE [dbo].[Resumes] ADD  DEFAULT (getdate()) FOR [lastUpdated]
GO
ALTER TABLE [dbo].[Resumes] ADD  DEFAULT ((1)) FOR [resumeFlag]
GO
ALTER TABLE [dbo].[UserAccounts] ADD  DEFAULT ((1)) FOR [accountFlag]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Applications] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobPostID@Applications]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Applications] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobseekerID@Applications]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Bookmarks] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobPostID@Bookmarks]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Bookmarks] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobseekerID@Bookmarks]
GO
ALTER TABLE [dbo].[Employers]  WITH CHECK ADD  CONSTRAINT [FK_email@Employers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Employers] CHECK CONSTRAINT [FK_email@Employers]
GO
ALTER TABLE [dbo].[JBSK_Notifications]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Notifications] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[JBSK_Notifications] CHECK CONSTRAINT [FK_jobseekerID@Notifications]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [FK_employerID@JobPosts] FOREIGN KEY([employerID])
REFERENCES [dbo].[Employers] ([employerID])
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [FK_employerID@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [FK_email@JobSeekers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [FK_email@JobSeekers]
GO
ALTER TABLE [dbo].[Resumes]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Resumes] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Resumes] CHECK CONSTRAINT [FK_jobseekerID@Resumes]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [CK_status@Applications] CHECK  (([status]='Rejected' OR [status]='Interviewing' OR [status]='Hired' OR [status]='Pending'))
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [CK_status@Applications]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_jobType@JobPosts] CHECK  (([jobType]='Temporary' OR [jobType]='Intern/OJT' OR [jobType]='Part Time' OR [jobType]='Full Time'))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_jobType@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_maxSalary@JobPosts] CHECK  (([maxSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_maxSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_minSalary@JobPosts] CHECK  (([minSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_minSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [CK_gender@JobSeekers] CHECK  (([gender]='Prefer not to say' OR [gender]='LGBTQA+' OR [gender]='Female' OR [gender]='Male'))
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [CK_gender@JobSeekers]
GO
ALTER TABLE [dbo].[UserAccounts]  WITH CHECK ADD  CONSTRAINT [CK_userType@UserAccounts] CHECK  (([userType]='Employer' OR [userType]='Jobseeker'))
GO
ALTER TABLE [dbo].[UserAccounts] CHECK CONSTRAINT [CK_userType@UserAccounts]
GO
/****** Object:  StoredProcedure [dbo].[AUTH_AddUserAccount]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Add Job Seeker Account Procedure
CREATE PROCEDURE [dbo].[AUTH_AddUserAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX),
	@userType			VARCHAR(MAX)
AS
	INSERT INTO [UserAccounts] 
		( [email]
		, [password]
		, [userType] )
	VALUES 
		( @email
		, @password
		, @userType )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_CreateJBSKNotification]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Create JBSK Notifications
CREATE PROCEDURE [dbo].[AUTH_CreateJBSKNotification]
	@jobseekerID		INT,
	@title				VARCHAR(MAX),
	@message			VARCHAR(MAX),
	@notificationType	VARCHAR(MAX),
	@link				VARCHAR(MAX)
AS
	INSERT INTO [JBSK_Notifications] 
		( [jobseekerID]
		, [title]
		, [message]
		, [notificationType]
		, [link] )
	VALUES
		( @jobseekerID
		, @title
		, @message
		, @notificationType
		, @link )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindEmployer]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find Employer Procedure
CREATE PROCEDURE [dbo].[AUTH_FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [Employers]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindJobseeker]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find Job Seeker Procedure
CREATE PROCEDURE [dbo].[AUTH_FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT *, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
	FROM [JobSeekers]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindUserAccount]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find User Account Procedure for Login
CREATE PROCEDURE [dbo].[AUTH_FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT
		  [userID]
		, [email]
		, [password]
		, [userType]
		, CAST([accountFlag] AS INT) AS [accountFlag]
	FROM [UserAccounts]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_GetUserPassword]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get User Password
CREATE PROCEDURE [dbo].[AUTH_GetUserPassword]
	@email VARCHAR(450)
AS
	SELECT [password] FROM [UserAccounts]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterEmployer]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Register Employer Procedure
CREATE PROCEDURE [dbo].[AUTH_RegisterEmployer]
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	INSERT INTO [Employers]
		( [companyName]
		, [street]
		, [brgyDistrict]
		, [cityProvince]
		, [contactNumber]
		, [email]
		, [website]
		, [description] )
	VALUES
		( @companyName
		, @street
		, @brgyDistrict
		, @cityProvince
		, @contactNumber
		, @email
		, @website
		, @description )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterJobseeker]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Register Job Seeker Procedure
CREATE PROCEDURE [dbo].[AUTH_RegisterJobseeker]
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450)
AS
	INSERT INTO [JobSeekers] 
		( [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, [gender]
		, [cityProvince]
		, [contactNumber]
		, [email] )
	VALUES 
		( @firstName
		, @middleName
		, @lastName
		, @birthDate
		, @gender
		, @cityProvince
		, @contactNumber
		, @email )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_SetAccountFlag]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Account Procedure
CREATE PROCEDURE [dbo].[AUTH_SetAccountFlag]
	@email VARCHAR(450),
	@flag  INT
AS
	UPDATE [UserAccounts]
	SET [accountFlag] = @flag
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_UpdateEmail]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Change User Email
CREATE PROCEDURE [dbo].[AUTH_UpdateEmail]
	@email		VARCHAR(450),
	@newEmail	VARCHAR(450)
AS
	UPDATE [UserAccounts]
	SET [email] = @newEmail
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_UpdatePassword]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Password
CREATE PROCEDURE [dbo].[AUTH_UpdatePassword]
	@email		VARCHAR(450),
	@password	VARCHAR(MAX)
AS
	UPDATE [UserAccounts]
	SET [password] = @password
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ApplicantsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ApplicantsNum]
	@jobPostID INT,
	@status	   VARCHAR(MAX)
AS
	SELECT COUNT([Applications].[applicationID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_DeletePost]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Delete Job Post Procedure
CREATE PROCEDURE [dbo].[EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_GetPosts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Limited Posts Procedure
CREATE PROCEDURE [dbo].[EMPL_GetPosts] 
	@offsetRows  INT,
	@fetchedRows INT,
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	FULL OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO
/****** Object:  StoredProcedure [dbo].[EMPL_PostNewJob]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Post New Job Procedure
CREATE PROCEDURE [dbo].[EMPL_PostNewJob]
	@employerID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	INSERT INTO [JobPosts]
		( [employerID]
		, [jobTitle]
		, [jobType]
		, [field]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [jobPostFlag])
	VALUES
		( @employerID
		, @jobTitle			
		, @jobType			
		, @field		
		, @description	
		, @responsibilities
		, @skills		
		, @experiences	
		, @education	
		, @minSalary		
		, @maxSalary		
		, @jobPostFlag )
GO
/****** Object:  StoredProcedure [dbo].[EMPL_PostsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Posts
CREATE PROCEDURE [dbo].[EMPL_PostsNum] 
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [JobPosts]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetApplicantStatus]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Applicant Status Procedure
CREATE PROCEDURE [dbo].[EMPL_SetApplicantStatus]
	@applicationID INT,
	@status		   VARCHAR(MAX)
AS
	UPDATE [Applications]
	SET [status] = @status
	WHERE [applicationID] = @applicationID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetProfilePic]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Profile Pic
CREATE PROCEDURE [dbo].[EMPL_SetProfilePic]
	@employerID INT,
	@profilePic	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET [profilePic] = @profilePic
	WHERE [employerID] = @employerID

GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdateInfo]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Employer Information Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdateInfo]
	@employerID		INT,
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET
		  [companyName] 	= @companyName
		, [street] 			= @street
		, [brgyDistrict] 	= @brgyDistrict
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
		, [website] 		= @website
		, [description] 	= @description
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdatePost]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Job Post Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdatePost]
	@jobPostID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	UPDATE [JobPosts]
	SET
		  [jobTitle] 			= @jobTitle
		, [jobType] 			= @jobType
		, [field] 				= @field
		, [description] 		= @description
		, [responsibilities] 	= @responsibilities
		, [skills] 				= @skills
		, [experiences] 		= @experiences
		, [education] 			= @education
		, [minSalary] 			= @minSalary
		, [maxSalary] 			= @maxSalary
		, [dateModified] 		= getdate()
		, [jobPostFlag] 		= @jobPostFlag
	WHERE [jobPostID]			= @jobPostID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicantProfile]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Applicant Profile Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewApplicantProfile]
	@jobseekerID INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[birthDate]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[resumeFile]
		, [JobPosts].[jobTitle]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	WHERE [Applications].[jobPostID] = @jobPostID

GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicants]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewPost]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Post
CREATE PROCEDURE [dbo].[EMPL_ViewPost]
	@jobPostID	INT,
	@employerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, [JobPosts].[jobPostFlag]
GO
/****** Object:  StoredProcedure [dbo].[JBSK_AddBookmark]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Add Bookmark Procedure
CREATE PROCEDURE [dbo].[JBSK_AddBookmark]
	@jobseekerID INT,
	@jobPostID	 INT
AS
	INSERT INTO [Bookmarks]
		( [jobseekerID]
		, [jobPostID] )
	VALUES 
		( @jobseekerID
		, @jobPostID )

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ApplicationStatus]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Details 
CREATE PROCEDURE [dbo].[JBSK_ApplicationStatus]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	SELECT
		  [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[dateApplied]
		, [Applications].[status] AS [applicationStatus]
		, [Applications].[dateStatus]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[jobPostFlag] = 1

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsNum]
	@jobseekerID INT
AS
	SELECT COUNT([Applications].[JobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsToStatus]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsToStatus]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [Bookmarks].[bookmarkID]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	INNER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsToStatusNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsToStatusNum]
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status

GO
/****** Object:  StoredProcedure [dbo].[JBSK_BookmarksNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Number of Bookmarks
CREATE PROCEDURE [dbo].[JBSK_BookmarksNum]
	@jobseekerID INT
AS
	SELECT COUNT([Bookmarks].[bookmarkID]) AS [count]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_CancelApplication]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Cancel Application Procedure
CREATE PROCEDURE [dbo].[JBSK_CancelApplication]
	@applicationID INT
AS
	DELETE FROM [Applications]
	WHERE [applicationID] = @applicationID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_CreateResume]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Create Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_CreateResume]
	@jobseekerID	INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	INSERT INTO [Resumes]
		( [jobseekerID]
		, [headline]
		, [description]
		, [education]
		, [skills]
		, [experiences]
		, [resumeFlag] )
	VALUES
		( @jobseekerID
		, @headline
		, @description
		, @education
		, @skills
		, @experiences
		, @resumeFlag )

GO
/****** Object:  StoredProcedure [dbo].[JBSK_GetBookmarks]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Bookmarks
CREATE PROCEDURE [dbo].[JBSK_GetBookmarks]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [Bookmarks].[bookmarkID]
		, [Bookmarks].[dateBookmarked]
		, [Bookmarks].[jobseekerID]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Applications].[status]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Bookmarks].[dateBookmarked] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROW ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RecentPostsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View All Recent Posts
CREATE PROCEDURE [dbo].[JBSK_RecentPostsNum]
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RemoveBookmark]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Remove Bookmark Procedure
CREATE PROCEDURE [dbo].[JBSK_RemoveBookmark]
	@bookmarkID INT
AS
	DELETE FROM [Bookmarks] WHERE [bookmarkID] = @bookmarkID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RemoveResume]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Remove Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_RemoveResume]
	@resumeID INT
AS
	DELETE FROM [Resumes] WHERE [resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SearchResultNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Search Result
CREATE PROCEDURE [dbo].[JBSK_SearchResultNum]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SetProfilePic]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Profile Pic
CREATE PROCEDURE [dbo].[JBSK_SetProfilePic]
	@jobseekerID INT,
	@profilePic	 VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET [profilePic] = @profilePic
	WHERE [jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SubmitApplication]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Submit Application Procedure
CREATE PROCEDURE [dbo].[JBSK_SubmitApplication]
	@jobPostID INT,
	@resumeID  INT
AS
	INSERT INTO [Applications]
		( [jobPostID]
		, [jobseekerID]
		, [headline]
		, [description]
		, [education]
		, [skills] 
		, [experiences] 
		, [resumeFile]
		, [lastUpdated] )
	SELECT
		  [JobPosts].[jobPostID]
		, [Resumes].[jobseekerID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[skills]
		, [Resumes].[experiences]
		, [Resumes].[resumeFile]
		, [Resumes].[lastUpdated]
	FROM [Resumes]
	LEFT OUTER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = @jobPostID
	WHERE
		[Resumes].[resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_UpdateInfo]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Job Seeker Information Procedure
CREATE PROCEDURE [dbo].[JBSK_UpdateInfo]
	@jobseekerID	INT,
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET
		  [firstName] 		= @firstName
		, [middleName] 		= @middleName
		, [lastName] 		= @lastName
		, [birthDate] 		= @birthDate
		, [gender] 			= @gender
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
	WHERE [jobseekerID]		= @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_UpdateResume]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_UpdateResume]
	@resumeID INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	UPDATE [Resumes]
	SET 
		  [headline]	= @headline
		, [description]	= @description
		, [education]	= @education
		, [skills]		= @skills
		, [experiences] = @experiences
		, [resumeFlag]	= @resumeFlag
	WHERE [resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewAvailableJobs]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Available Jobs
CREATE PROCEDURE [dbo].[JBSK_ViewAvailableJobs]
	@jobseekerID INT,
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewRecentPosts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Recent Posts
CREATE PROCEDURE [dbo].[JBSK_ViewRecentPosts]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewResume]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_ViewResume]
	@jobseekerID INT
AS
	SELECT
		  [Resumes].[resumeID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[experiences]
		, [Resumes].[skills]
		, [Resumes].[lastUpdated]
		, CAST([Resumes].[resumeFlag] AS INT) AS [resumeFlag]
		, [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, CONVERT(INT, ROUND(DATEDIFF(hour, [birthDate], GETDATE())/8766.0,0)) AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
	FROM [Resumes]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewSearchResult]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Search Result
CREATE PROCEDURE [dbo].[JBSK_ViewSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)
	ORDER BY [JobPosts].[dateCreated]
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[MAIN_AvailableJobs]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Available Jobs
CREATE PROCEDURE [dbo].[MAIN_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE [employerID] = @employerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO
/****** Object:  StoredProcedure [dbo].[MAIN_AvailableJobsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Number of Available Jobs
CREATE PROCEDURE [dbo].[MAIN_AvailableJobsNum]
	@employerID  INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[MAIN_CompanyDetails]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Employer Details Procedure
CREATE PROCEDURE [dbo].[MAIN_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityProvince] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[MAIN_GetSearchResult]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--  Get Search Result
CREATE PROCEDURE [dbo].[MAIN_GetSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;

GO
/****** Object:  StoredProcedure [dbo].[MAIN_JobDetails]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Details Procedure
CREATE PROCEDURE [dbo].[MAIN_JobDetails]
	@jobPostID	INT
AS
	SELECT * FROM [JobDetails]
	WHERE jobPostID = @jobPostID

GO
/****** Object:  StoredProcedure [dbo].[MAIN_RecentPosts]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Active Posts
CREATE PROCEDURE [dbo].[MAIN_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT * FROM [Posts]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO
/****** Object:  StoredProcedure [dbo].[MAIN_RecentPostsNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Number of Active Posts
CREATE PROCEDURE [dbo].[MAIN_RecentPostsNum]
AS 
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]

GO
/****** Object:  StoredProcedure [dbo].[MAIN_SearchResultNum]    Script Date: 06/02/2021 6:36:18 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


-- Get Number of Search Result
CREATE PROCEDURE [dbo].[MAIN_SearchResultNum]
	@jobTitle VARCHAR(MAX),
	@location VARCHAR(MAX)
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')

GO
USE [master]
GO
ALTER DATABASE [ABN_Job_Portal] SET  READ_WRITE 
GO
